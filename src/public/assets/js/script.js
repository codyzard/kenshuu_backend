$(document).ready(function () {
  // dynamic select
  $("#categories").select2({
    placeholder: "カテゴライズを1以上選んで。。。",
  });

  // show list of image's name when seleted images
  $("#images").change(function () {
    let files = Array.from(this.files);
    if ($(".images-choosen").children().length > 0)
      $(".images-choosen").empty();
    files.forEach((f, i) => {
      let rd = document.createElement("input");
      let label = document.createElement("label");
      let file_group = document.createElement("div");
      file_group.classList.add("images-choosen__item");
      rd.type = "radio";
      rd.name = "thumbnail";
      rd.value = f.name;
      rd.id = "rd" + i;
      rd.required = true;
      label.textContent = f.name;
      label.htmlFor = rd.id;
      file_group.append(rd);
      file_group.append(label);
      $(".images-choosen").append(file_group);
    });
  });
  
  // create condition show/hidden password
  $(".show-hide-pw").each(function () {
    let show_pw_btn = this;
    $(this).click(function () {
      let input_pw = this.parentNode.querySelector("input");
      if (input_pw && input_pw.type == "password") {
        input_pw.type = "text";
        show_pw_btn.textContent = "非表示";
      } else {
        input_pw.type = "password";
        show_pw_btn.textContent = "表示";
      }
    });
  });
});
