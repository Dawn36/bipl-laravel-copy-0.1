$(".toggle-password").click(function () {
    $(this).toggleClass("bi-eye-slash bi-eye");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

(function () {
    "use strict";
    const forms = document.querySelectorAll(".requires-validation");
    Array.from(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();
$(".toggle-password").click(function () {
    $(this).toggleClass("bi-eye-slash bi-eye");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

(function () {
    "use strict";
    const forms = document.querySelectorAll(".requires-validation");
    Array.from(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();

const form = document.querySelector("#opt_verify");
const inputs = form.querySelectorAll(".otp_box");
const KEYBOARDS = {
    backspace: 8,
    arrowLeft: 37,
    arrowRight: 39,
};

function handleInput(e) {
    const input = e.target;
    const nextInput = input.nextElementSibling;
    if (nextInput && input.value) {
        nextInput.focus();
        if (nextInput.value) {
            nextInput.select();
        }
    }
}

function handlePaste(e) {
    e.preventDefault();
    const paste = e.clipboardData.getData("text");
    inputs.forEach((input, i) => {
        input.value = paste[i] || "";
    });
}

function handleBackspace(e) {
    const input = e.target;
    if (input.value) {
        input.value = "";
        return;
    }

    input.previousElementSibling.focus();
}

function handleArrowLeft(e) {
    const previousInput = e.target.previousElementSibling;
    if (!previousInput) return;
    previousInput.focus();
}

function handleArrowRight(e) {
    const nextInput = e.target.nextElementSibling;
    if (!nextInput) return;
    nextInput.focus();
}

form.addEventListener("input", handleInput);
inputs[0].addEventListener("paste", handlePaste);

inputs.forEach((input) => {
    input.addEventListener("focus", (e) => {
        setTimeout(() => {
            e.target.select();
        }, 0);
    });

    input.addEventListener("keydown", (e) => {
        switch (e.keyCode) {
            case KEYBOARDS.backspace:
                handleBackspace(e);
                break;
            case KEYBOARDS.arrowLeft:
                handleArrowLeft(e);
                break;
            case KEYBOARDS.arrowRight:
                handleArrowRight(e);
                break;
            default:
        }
    });
});
