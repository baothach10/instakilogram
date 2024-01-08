document.getElementById("heart_nav").onclick = function(){change_color(document.getElementById("heart_nav"))};
function change_color(element) {
  if (element.style.color == "" || element.style.color == "black"){
    element.style.color = "red";
  } else{
    element.style.color = "black";
  }
}

var heart_click = document.querySelectorAll(".heart");
for (i = 0; i < heart_click.length; i++) {
  let click = heart_click[i];
  click.onclick = function () {
    heart_click_fuc(click);
  };
}

function heart_click_fuc(element) {
  if (element.classList.contains("liked") === true) {
    element.classList.remove("liked", "fas");
    element.classList.add("icon-size", "far");
  } else {
    element.classList.remove("icon-size", "far");
    element.classList.add("liked", "fas");
  }
}

var bookmark_click = document.querySelectorAll(".bookmark");
for (i = 0; i < bookmark_click.length; i++) {
  let click = bookmark_click[i];
  click.onclick = function () {
    bookmark_click_fuc(click);
  };
}

function bookmark_click_fuc(element) {
  if (element.classList.contains("fas") === true) {
    element.classList.remove("fas");
    element.classList.add("far");
  } else {
    element.classList.remove("far");
    element.classList.add("fas");
  }
}
