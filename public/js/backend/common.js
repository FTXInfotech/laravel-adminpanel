// common utility 

var Common = {};    // common variable

(function(){
    Common = {
        Utils: {
            DataTables: {
                CreateRow: function( row, data, dataIndex){
                    let deleteAction = row.querySelector('[data-method]');
                    let form = document.createElement('FORM');
                    form.method = 'POST';
                    form.action = deleteAction.href;
                    form.name = 'delete_item';
                    form.style.display = 'none';

                    let inputMethod = document.createElement('input');
                    inputMethod.setAttribute('type','hidden');
                    inputMethod.setAttribute('name','_method');
                    inputMethod.value = 'delete';
                    form.appendChild(inputMethod);

                    let token = document.createElement('input');
                    token.setAttribute('type', 'hidden');
                    token.setAttribute('name', '_token');
                    token.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(token);
                    
                    deleteAction.appendChild(form);
                    deleteAction.onclick = function(e)
                    {
                        e.preventDefault();
                        deleteAction.querySelector('form').submit();
                    }
                }
            } 
        }
    }

})();