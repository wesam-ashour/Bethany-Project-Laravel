"use strict";
var KTAccountSettingsProfileDetails = function () {
    var e, t;
    return {
        init: function () {
            e = document.getElementById("kt_account_profile_details_form"), e.querySelector("#kt_account_profile_details_submit"), t = FormValidation.formValidation(e, {
                fields: {
                    name: {validators: {notEmpty: {message: "First name is required"}}},
                    lname: {validators: {notEmpty: {message: "Last name is required"}}},
                    company: {validators: {notEmpty: {message: "Company name is required"}}},
                    phone: {validators: {notEmpty: {message: "Contact phone number is required"}}},
                    country: {validators: {notEmpty: {message: "Please select a country"}}},
                    timezone: {validators: {notEmpty: {message: "Please select a timezone"}}},
                    "communication[]": {validators: {notEmpty: {message: "Please select at least one communication method"}}},
                    language: {validators: {notEmpty: {message: "Please select a language"}}}
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    submitButton: new FormValidation.plugins.SubmitButton,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), $(e.querySelector('[name="country"]')).on("change", (function () {
                t.revalidateField("country")
            })), $(e.querySelector('[name="language"]')).on("change", (function () {
                t.revalidateField("language")
            })), $(e.querySelector('[name="timezone"]')).on("change", (function () {
                t.revalidateField("timezone")
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTAccountSettingsProfileDetails.init()
}));
