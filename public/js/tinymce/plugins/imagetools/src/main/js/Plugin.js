/**
 * Plugin.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2016 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/**
 *
 * Settings:
 *  imagetools_cors_hosts - Array of remote domains that has CORS setup.
 *  imagetools_proxy - Url to proxy that streams images from remote host to local host.
 *  imagetools_toolbar - Toolbar items to render when an editable image is selected.
 */
define("tinymce/imagetoolsplugin/Plugin", [
	"global!tinymce.PluginManager",
	"global!tinymce.Env",
	"global!tinymce.util.Promise",
	"global!tinymce.util.URI",
	"global!tinymce.util.Tools",
	"global!tinymce.util.Delay",
	"ephox/imagetools/api/ImageTransformations",
	"ephox/imagetools/api/BlobConversions",
	"tinymce/imagetoolsplugin/Dialog"
], function(PluginManager, Env, Promise, URI, Tools, Delay, ImageTransformations, BlobConversions, Dialog) {
	var plugin = function(editor) {
		var count = 0, imageUploadTimer, lastSelectedImage;

		if (!Env.fileApi) {
			return;
		}

		/*
		function startCrop() {
			var imageRect, viewPortRect;

			imageRect = getSelectedImage().getBoundingClientRect();

			imageRect = {
				x: imageRect.left,
				y: imageRect.top,
				w: imageRect.width,
				h: imageRect.height
			};

			viewPortRect = {
				x: 0,
				y: 0,
				w: editor.getBody().scrollWidth,
				h: editor.getBody().scrollHeight
			};

			cropRect = new CropRect(imageRect, viewPortRect, imageRect, editor.getBody());
			cropRect.toggleVisibility(true);

			editor.selection.getSel().removeAllRanges();
			editor.nodeChanged();
		}

		function stopCrop() {
			if (cropRect) {
				cropRect.destroy();
				cropRect = null;
			}
		}
		*/

		function getImageSize(img) {
			var width, height;

			function isPxValue(value) {
				return value.indexOf('px') == value.length - 2;
			}

			width = img.style.width;
			height = img.style.height;
			if (width || height) {
				if (isPxValue(width) && isPxValue(height)) {
					return {
						w: parseInt(width, 10),
						h: parseInt(height, 10)
					};
				}

				return null;
			}

			width = editor.$(img).attr('width');
			height = editor.$(img).attr('height');
			if (width && height) {
				return {
					w: parseInt(width, 10),
					h: parseInt(height, 10)
				};
			}

			return null;
		}

		function setImageSize(img, size) {
			var width, height;

			if (size) {
				width = img.style.width;
				height = img.style.height;

				if (width || height) {
					editor.$(img).css({
						width: size.w,
						height: size.h
					}).removeAttr('data-mce-style');
				}

				width = img.width;
				height = img.height;

				if (width || height) {
					editor.$(img).attr({
						width: size.w,
						height: size.h
					});
				}
			}
		}

		function getNaturalImageSize(img) {
			return {
				w: img.naturalWidth,
				h: img.naturalHeight
			};
		}

		function getSelectedImage() {
			return editor.selection.getNode();
		}

		function createId() {
			return 'imagetools' + count++;
		}

		function isLocalImage(img) {
			var url = img.src;

			return url.indexOf('data:') === 0 || url.indexOf('blob:') === 0 || new URI(url).host === editor.documentBaseURI.host;
		}

		function isCorsImage(img) {
			return Tools.inArray(editor.settings.imagetools_cors_hosts, new URI(img.src).host) !== -1;
		}

		function getApiKey() {
			return editor.settings.api_key || editor.settings.imagetools_api_key;
		}

		function requestUrlAsBlob(url) {
			return new Promise(function(resolve) {
				var xhr, apiKey;

				xhr = new XMLHttpRequest();
				xhr.onload = function() {
					resolve(this.response);
				};

				xhr.open('GET', url, true);

				apiKey = getApiKey();
				if (apiKey) {
					xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
					xhr.setRequestHeader('tiny-api-key', apiKey);
				}

				xhr.responseType = 'blob';
				xhr.send();
			});
		}

		function imageToBlob(img) {
			var src = img.src;

			if (isCorsImage(img)) {
				return requestUrlAsBlob(img.src);
			}

			if (!isLocalImage(img)) {
				src = editor.settings.imagetools_proxy;
				src += (src.indexOf('?') === -1 ? '?' : '&') + 'url=' + encodeURIComponent(img.src);

				if (getApiKey()) {
					return requestUrlAsBlob(src);
				}

				img = new Image();
				img.src = src;
			}

			return BlobConversions.imageToBlob(img);
		}

		function findSelectedBlobInfo() {
			var blobInfo;

			blobInfo = editor.editorUpload.blobCache.getByUri(getSelectedImage().src);
			if (blobInfo) {
				return blobInfo;
			}

			return imageToBlob(getSelectedImage()).then(function(blob) {
				return BlobConversions.blobToBase64(blob).then(function(base64) {
					var blobCache = editor.editorUpload.blobCache;
					var blobInfo = blobCache.create(createId(), blob, base64);
					blobCache.add(blobInfo);
					return blobInfo;
				});
			});
		}

		function startTimedUpload() {
			imageUploadTimer = Delay.setEditorTimeout(editor, function() {
				editor.editorUpload.uploadImagesAuto();
			}, 30000);
		}

		function cancelTimedUpload() {
			clearTimeout(imageUploadTimer);
		}

		function updateSelectedImage(blob, uploadImmediately) {
			return BlobConversions.blobToDataUri(blob).then(function(dataUri) {
				var id, base64, blobCache, blobInfo, selectedImage;

				selectedImage = getSelectedImage();
				id = createId();
				blobCache = editor.editorUpload.blobCache;
				base64 = URI.parseDataUri(dataUri).data;

				blobInfo = blobCache.create(id, blob, base64);
				blobCache.add(blobInfo);

				editor.undoManager.transact(function() {
					function imageLoadedHandler() {
						editor.$(selectedImage).off('load', imageLoadedHandler);
						editor.nodeChanged();

						if (uploadImmediately) {
							editor.editorUpload.uploadImagesAuto();
						} else {
							cancelTimedUpload();
							startTimedUpload();
						}
					}

					editor.$(selectedImage).on('load', imageLoadedHandler);

					editor.$(selectedImage).attr({
						src: blobInfo.blobUri()
					}).removeAttr('data-mce-src');
				});

				return blobInfo;
			});
		}

		function selectedImageOperation(fn) {
			return function() {
				return editor._scanForImages().then(findSelectedBlobInfo).then(fn).then(updateSelectedImage);
			};
		}

		function rotate(angle) {
			return function() {
				return selectedImageOperation(function(blobInfo) {
					var size = getImageSize(getSelectedImage());

					if (size) {
						setImageSize(getSelectedImage(), {
							w: size.h,
							h: size.w
						});
					}

					return ImageTransformations.rotate(blobInfo.blob(), angle);
				})();
			};
		}

		function flip(axis) {
			return function() {
				return selectedImageOperation(function(blobInfo) {
					return ImageTransformations.flip(blobInfo.blob(), axis);
				})();
			};
		}

		function editImageDialog() {
			var img = getSelectedImage(), originalSize = getNaturalImageSize(img);

			if (img) {
				imageToBlob(img).then(Dialog.edit).then(function(blob) {
					return new Promise(function(resolve) {
						BlobConversions.blobToImage(blob).then(function(newImage) {
							var newSize = getNaturalImageSize(newImage);

							if (originalSize.w != newSize.w || originalSize.h != newSize.h) {
								if (getImageSize(img)) {
									setImageSize(img, newSize);
								}
							}

							URL.revokeObjectURL(newImage.src);
							resolve(blob);
						});
					});
				}).then(function(blob) {
					updateSelectedImage(blob, true);
				}, function() {
					// Close dialog
				});
			}
		}

		function addButtons() {
			editor.addButton('rotateleft', {
				title: 'Rotate counterclockwise',
				onclick: rotate(-90)
			});

			editor.addButton('rotateright', {
				title: 'Rotate clockwise',
				onclick: rotate(90)
			});

			editor.addButton('flipv', {
				title: 'Flip vertically',
				onclick: flip('v')
			});

			editor.addButton('fliph', {
				title: 'Flip horizontally',
				onclick: flip('h')
			});

			editor.addButton('editimage', {
				title: 'Edit image',
				onclick: editImageDialog
			});

			editor.addButton('imageoptions', {
				title: 'Image options',
				icon: 'options',
				cmd: 'mceImage'
			});

			/*
			editor.addButton('crop', {
				title: 'Crop',
				onclick: startCrop
			});
			*/
		}

		function addEvents() {
			editor.on('NodeChange', function(e) {
				//If the last node we selected was an image
				//And had a source that doesn't match the current blob url
				//We need to attempt to upload it
				if (lastSelectedImage && lastSelectedImage.src != e.element.src) {
					cancelTimedUpload();
					editor.editorUpload.uploadImagesAuto();
					lastSelectedImage = undefined;
				}

				//Set up the lastSelectedImage
				if (isEditableImage(e.element)) {
					lastSelectedImage = e.element;
				}
			});
		}

		function isEditableImage(img) {
			var selectorMatched = editor.dom.is(img, 'img:not([data-mce-object],[data-mce-placeholder])');

			return selectorMatched && (isLocalImage(img) || isCorsImage(img) || editor.settings.imagetools_proxy);
		}

		function addToolbars() {
			var toolbarItems = editor.settings.imagetools_toolbar;

			if (!toolbarItems) {
				toolbarItems = 'rotateleft rotateright | flipv fliph | crop editimage imageoptions';
			}

			editor.addContextToolbar(
				isEditableImage,
				toolbarItems
			);
		}

		addButtons();
		addToolbars();
		addEvents();

		editor.addCommand('mceEditImage', editImageDialog);
	};

	PluginManager.add('imagetools', plugin);

	return function() {};
});
