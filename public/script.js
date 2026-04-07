// Form validation
const validation = new JustValidate("#register-form");

validation
  .addField("#name", [{ rule: "required" }])
  .addField("#email", [
    { rule: "required" },
    { rule: "email" },
    {
      validator: (value) => async () => {
        return await fetch(
          `../src/validate-email.php?email=${encodeURIComponent(value)}`,
        )
          .then((res) => {
            return res.json();
          })
          .then((json) => {
            return json.isAvailable;
          });
      },
      errorMessage: "Email already taken.",
    },
  ])
  .addField("#password", [{ rule: "required" }, { rule: "password" }])
  .addField("#password-confirm", [
    {
      validator: (value, fields) => {
        return value === fields["#password"].elem.value;
      },
      errorMessage: "Passwords do not match.",
    },
  ])
  .onSuccess((event) => {
    document.getElementById("register-form").submit();
  });
