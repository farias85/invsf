/**
 * Created by webind on 22/05/2017.
 */
myApp.config(["$routeProvider", function ($routeProvider) {

    $routeProvider
      .when("/", {
          controller: "LoginController",
          templateUrl: "login",
        }
      )
      .when("/maincotainer", {
          controller: "MainController",
          templateUrl: "maincotainer",
        }
      )
      .when("/makemedicalquery", {
          controller: "WizardController",
          templateUrl: "makemedicalquery",
        }
      )
      .when("/royalmedicalquery", {
          controller: "QueryWizardController",
          templateUrl: "royalmedicalquery",
        }
      )
      .when("/viewquery", {
          controller: "MainController",
          templateUrl: "viewquery",
        }
      )
      .when("/wizard", {
          controller: "CalendarController",
          templateUrl: "wizard",
        }
      )
      .when("/newquery", {
          controller: "QueryListController",
          templateUrl: "newquery",
        }
      )
      .when("/wmodalMessage", {
          controller: "ModalInstanceMessage",
          templateUrl: "modalMessage",
        }
      )
      .otherwise("/");
  }]
);
