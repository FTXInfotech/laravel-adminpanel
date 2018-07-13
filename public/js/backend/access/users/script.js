window.onload = function () {
   document.querySelectorAll(".show-permissions").forEach(function(element){
        element.onclick = function(event){
            event.preventDefault();
            var $this = this;
            var role = $this.getAttribute("data-role");
    
            var permissions = document.querySelector(".permission-list[data-role='"+role+"']");
            var hideText = $this.querySelector('.hide-text');
            var showText = $this.querySelector('.show-text');
    
            // show permission list
            Backend.Utils.toggleClass(permissions,'hidden');
    
            // toggle the text Show/Hide for the link
            Backend.Utils.toggleClass(hideText,'hidden');
            Backend.Utils.toggleClass(showText,'hidden');
        };
    });
  
};

