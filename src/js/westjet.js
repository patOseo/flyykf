var WJwidget = WJwidget || (function(){
    var _args = {}; 
    const files = {
      plusgrade: {
        umd: 'https://westjet.com/booking-widget/plusgrade/wjPlusgrade.umd.min.js',
        css: 'https://westjet.com/booking-widget/plusgrade/wjPlusgrade.css',
      },
      booking: {
        umd: 'https://westjet.com/booking-widget/wjWidgets.umd.min.js',
        css: 'https://westjet.com/booking-widget/wjWidgets.css',
      },
      vacations: {
        umd: 'https://westjet.com/booking-widget/vacations/wjVacations.umd.min.js',
        css: 'https://westjet.com/booking-widget/vacations/wjVacations.css',
      },
      managevacations: {
        umd: 'https://westjet.com/booking-widget/manage-vacations/wjVacationsManage.umd.min.js',
        css: 'https://westjet.com/booking-widget/manage-vacations/wjVacationsManage.css',
      }
    };
  
    return {
        init : function(Args) {
            _args = Args;
            _args.widget = _args.widget || 'booking';
            _args.id = _args.id || 'WJwidget';
            _args.wjlogo = _args.wjlogo === false ? false : true;
          
          // add required assets
          var wjWidgetStyle = document.createElement('link');
          wjWidgetStyle.setAttribute('href', files[_args.widget].css);
          wjWidgetStyle.setAttribute('rel', 'stylesheet');
          wjWidgetStyle.setAttribute('type', 'text/css');
          document.head.appendChild(wjWidgetStyle)
          
          var wjPoly = document.createElement('script');
          wjPoly.src = 'https://westjet.com/booking-widget/polyfills.js';
          document.head.appendChild(wjPoly); 
  
          var wjWidgets = document.createElement('script');
          wjWidgets.src = files[_args.widget].umd;
  
          if (_args.locale) {
            var meta = document.createElement('meta');
            meta.name = "wj.canonical-locale";
            meta.content = checkLocale(_args.locale);
            document.head.appendChild(meta);
          }
          if (_args.widget=='plusgrade') {
            wjWidgets.onload = function () {
              window.wjPlusgrade.initializeWidget('WidgetPlusgrade', '#WJwidget', _args)
            };
          } else if (_args.widget=='vacations') {
              wjWidgets.onload = function () {
                window.wjVacations.initializeWidget('WidgetVacations', '#WJwidget', _args)
              };
          } else if (_args.widget=='managevacations') {
              wjWidgets.onload = function () {
                window.wjVacationsManage.initializeWidget('WidgetVacationsManage', '#WJwidget', _args)
              };
          } else {
            wjWidgets.onload = function () {
              window.wjWidgets.initializeWidget('WidgetBook', '#WJwidget', _args)
            };
          }
          document.head.appendChild(wjWidgets);
        },
        
    };
  }());
  
  function checkLocale(param) {
    let localeReg=new RegExp('^[a-z]{2}-[A-Z]{2}$');
    return localeReg.exec(param) === null ? "en-CA" : param; 
  }