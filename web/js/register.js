$(() => {
  const form = $("form");
  const url = $(location).attr("href");

  const ajax = (el) => {
    el.removeClass("is-invalid").removeClass("is-valid");

    if (el.attr("type") == "submit") {
      form.find("input.form-control, input:checkbox").removeClass("is-invalid");
    }

    let _el = el.length == 1 ? el : {};

    $.ajax({
      url: url,
      method: "post",
      data: form.serialize(),
      success: function (data_in) {
        if (el.attr("type") == "submit") {
          if (!Object.keys(data_in).length) {
            form.submit();
          } else {
            el = form.find("input.form-control, input:checkbox");
          }
        }

        for (let [key, data] of Object.entries(data_in)) {
          if (el.length > 1) {
            _el = el.filter(`#${key}`);
          }

          if (_el.attr("id") == key) {
            _el
              .addClass("is-invalid")
              .parent()
              .find(".invalid-feedback")
              .html(data[0]);
          }
        }

        if (!el.hasClass("is-invalid")) {
          el.addClass("is-valid");
        }
      },
    });
  };

  form.on("click", "button", function (e) {
    e.preventDefault();
    ajax($(this));
  });

  form.find("input:checkbox").on("click", function () {
    ajax($(this));
  });

  form.find("input").blur(function () {
    if (!$(this).is("input:checkbox")) {
      ajax($(this));
    }
  });
});
