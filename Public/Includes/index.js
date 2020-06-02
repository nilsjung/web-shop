/**
 * Shopping Cart Checkout Process
 */
(function (window, document) {
    class Button {
        constructor(label, onClick, type) {
            this.type = type || null;
            this.label = label;
            this.onClick = onClick;
        }

        render() {
            let button = document.createElement("button");
            button.innerHTML = this.label;
            button.className = "btn btn-primary";
            if (this.type) {
                button.type = this.type;
            }
            button.addEventListener("click", this.onClick);
            return button;
        }
    }

    /**
     *
     */
    class Input {
        constructor(label, id, classNames, type) {
            this.label = label || "";
            this.id = id || "";
            this.type = type || "input";
            this.classNames = classNames || "";
        }

        render() {
            let input = document.createElement("input");
            let label = document.createElement("label");

            input.id = this.id;
            input.type = this.type;
            input.name = this.id;
            input.className = this.classNames = " form-control";
            label.innerHTML = this.label;
            label.setAttribute("for", this.id);

            let container = document.createElement("div");
            container.className = "form-group";
            container.appendChild(label);
            container.appendChild(input);
            return container;
        }
    }

    class Radio extends Input {
        constructor(label, id, name, classNames, value) {
            super(label, id, classNames, "radio");
            this.label = label;
            this.name = name;
            this.values = value;
        }

        render() {
            let input = document.createElement("input");
            let label = document.createElement("label");

            input.id = this.id;
            input.type = this.type;
            input.name = this.name;
            input.value = this.value;
            input.className = this.classNames = " form-control";
            label.innerHTML = this.label;
            label.setAttribute("for", this.id);

            let container = document.createElement("div");
            container.className = "form-group";
            container.appendChild(label);
            container.appendChild(input);
            return container;
        }
    }

    let checkoutContainer = {
        paginationStep: 0,
        user: null,
        paymentMethod: null,
        container: null,
        __init: function (elem) {
            // if the node does not exists, quit initialization process
            if (!elem) {
                return;
            }
            let isAuthenticated = elem.getAttribute("data-is-authenticated");
            if (isAuthenticated === "true") {
                elem.appendChild(this.buildContainer());
                if (this.paginationStep === 0) {
                    console.warn("An Error occurred during the login process.");
                }
            } else {
                elem.appendChild(this.login());
            }
        },

        buildContainer: function (content) {
            this.container = document.createElement("div");
            let submitButton = new Button("next", function () {
                console.log("test");
            });
            this.container.appendChild(submitButton.render());
            return this.container;
        },

        login: function () {
            const _this = this;
            _this.container = document.createElement("form");
            _this.container.className = "login-container";

            let infoText = document.createElement("p");
            infoText.innerHTML =
                "<emph>You have to log in to proceed any further</emph>";

            let emailInput = new Input("Email", "email");
            let passwordInput = new Input(
                "Password",
                "password",
                "",
                "password"
            );
            let submitButton = new Button(
                "Login",
                function (event) {
                    event.preventDefault();
                    let request = new XMLHttpRequest();
                    request.open("post", "/shopping-cart/login");
                    request.responseType = "json";

                    let data = new FormData();
                    data.append("password", "test");
                    data.append("email", "test@user.com");
                    request.addEventListener("loadend", function (event) {
                        if (
                            event.target &&
                            event.target.status === 200 &&
                            event.target.response
                        ) {
                            let result = event.target.response.result;
                            _this.user = result.data;
                            _this.paginationStep = 1;
                            _this.container.innerHTML = "";

                            _this.payment();
                        }
                    });
                    request.send(data);
                },
                "submit"
            );

            _this.container.appendChild(infoText);
            _this.container.appendChild(emailInput.render());
            _this.container.appendChild(passwordInput.render());
            _this.container.appendChild(submitButton.render());
            return _this.container;
        },

        payment: function () {
            const _this = this;
            let welcome = document.createElement("div");
            welcome.innerHTML =
                "<p>Welcome " +
                _this.user.firstName +
                " " +
                _this.user.lastName +
                "</p>";
            _this.container.appendChild(welcome);

            let paymentForm = document.createElement("form");

            let paymentMethods = document.createElement("fieldset");
            let creditCard = new Radio(
                "Credit Card",
                "credit-card",
                "payment-method",
                "radio input",
                "credit-card"
            );
            let paypal = new Radio(
                "PayPal",
                "paypal",
                "payment-method",
                "paypal"
            );

            let buttonNext = new Button("Next", function () {
                _this.paginationStep = 3;
                _this.container.innerHTML = null;
            });

            paymentMethods.appendChild(creditCard.render());
            paymentMethods.appendChild(paypal.render());
            paymentMethods.appendChild(buttonNext.render());
            paymentForm.appendChild(paymentMethods);
            _this.container.appendChild(paymentForm);
        },
    };

    let root = document.querySelector("#checkout-container");
    checkoutContainer.__init(root);
})(window, document);
