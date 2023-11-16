<style>
    .my-4{
        margin-top: 0rem!important;
    }
</style>
<form id='contact_us' class="requires-validation" novalidate method="POST" action="{{ route('contact-us.store') }}">
@csrf
<div class="row">
    <div class="col-6 my-4 IPS-Form">
        <div class="input-group ">
            <span class="ar-lable d-none d-lg-flex">نام</span>
            <input type="text" class="form-control" type="text" name="name" placeholder="Name"
                value="{{ ucwords($data['Client_Name']) }}" required readonly>
        </div>
    </div>
    <div class="col-6 my-4 IPS-Form">
        <div class="input-group ">
            <span class="ar-lable d-none d-lg-flex">اکاؤنٹ نمبر</span>
            <input type="text" class="form-control" name="account_number"
                value="{{ ucwords($data['Account']) }}" placeholder="Account Number" required readonly>
        </div>
    </div>
    <div class="col-6 my-4 IPS-Form">
        <div class="input-group ">
            <span class="ar-lable d-none d-lg-flex">ای میل اڈریس</span>
            <input type="text" class="form-control" name="email"
                value="{{ ucwords($data['Email']) }}" placeholder="Email" required readonly>
        </div>
    </div>
    <div class="col-12 my-4 IPS-Form">
        <div class="input-group ">
            <span class="ar-lable d-none d-lg-flex">تفصیل</span>
            <textarea type="text" class="form-control" name="description" placeholder="Please enter description" required></textarea>
        </div>
    </div>
    <div class="text-center">
        <button type="submit"
            class="btn btn-rounded theme-btn pills-button"><i
                class="icons submit-icon me-3"></i>Submit</button>
    </div>
</div>
</form>
<script>
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
</script>