const textarea = $('[data-autoresize]');
setTimeout(function() {
  textarea.each(function () {
    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
  }).on("input", function () {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight-10) + "px";
  });

}, 100);
