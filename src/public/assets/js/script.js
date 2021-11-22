// dynamic select
$("#categories").select2({
  placeholder: "カテゴライズを1以上選んで。。。",
});

// show list of image's name when seleted images
$("#images").change(function () {
  let files = Array.from(this.files);
  if ($(".images-choosen").children().length > 0) $(".images-choosen").empty();
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
    console.log(f);
  });
});
