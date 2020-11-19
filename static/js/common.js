(function() {
  const header = document.querySelector('header');
  if(header) {
    new Vue({
      el: "header",
      data() {
        return {
          active: false,
        };
      },
      methods: {
        hamburgerHandler() {
          this.active = !this.active;
        },
        goBack() {
          history.go(-1);
        }
      },
    });
  }

})();

(function() {
  var Tools = {
    init: function() {
      // console.log("提取公共文件");
    },
    test: () => {

    },
    test2: () => {

    },
    test3: () => {

    }
  };

  Tools.init();
})();


