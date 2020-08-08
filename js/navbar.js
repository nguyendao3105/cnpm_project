// Burger's effect
const navSlide = () => {
  // burger
  const burger = document.querySelector(".burger");
  // nav + hider + body
  const navLinks = document.querySelector(".nav_links");
  const backgroundHider = document.querySelector(".background_hider");
  const body = document.querySelector("body");
  // each entry in nav_links
  navLinksEntries = navLinks.querySelectorAll("a");
  // menu nav container + btn nav container
  const topNavCon = navLinks.querySelector(".top_nav_con");
  const bottomNavCon = navLinks.querySelector(".bottom_nav_con");
  var totalEntries = countChild(topNavCon, "A") + countChild(bottomNavCon, "A");

  // Listener
  // burger's listener
  burger.addEventListener("click", () => {
    burgerToggle(navLinks, backgroundHider, body, burger);
    entriesAnimation(navLinksEntries, totalEntries, "fadeUp", [
      "top_nav_con",
      "bottom_nav_con",
    ]);
  });

  // background hider's listener
  backgroundHider.addEventListener("click", () => {
    burgerToggle(navLinks, backgroundHider, body, burger);
    entriesAnimation(navLinksEntries, totalEntries, "fadeUp", [
      "top_nav_con",
      "bottom_nav_con",
    ]);
  });
};

// Apply animation to each entry in the container
function entriesAnimation(container, entriesNum, keyframe, parentClass = []) {
  console.log("Number of entries:", entriesNum);
  container.forEach((link, index) => {
    if (parentClass.length > 0) {
      while (true) {
        var flag = false;
        for (var i = 0; i < parentClass.length; i++) {
          console.log(link.parentElement.getAttribute("class"), parentClass[i]);
          if (link.parentElement.getAttribute("class") == parentClass[i])
            flag = true;
        }
        if (flag) {
          console.log("Animation modified:", link);
          break;
        }
        if (link.style.opacity) {
          link.style.opacity = "";
        } else {
          link.style.opacity = 1;
        }
        link = link.parentElement;
      }
    }
    if (link.style.animation) {
      link.style.animation = "";
    } else {
      link.style.animation = `${keyframe} 0.5s ease forwards ${
        index / (entriesNum * 2)
      }s`;
    }
  });
}

// Burger's toggle function
function burgerToggle(navLinks, backgroundHider, body, burger) {
  navLinks.classList.toggle("bactive_nav"); // nav
  backgroundHider.classList.toggle("bactive_background_hider"); // nav hider
  body.classList.toggle("bactive_body"); // body overflow
  burger.classList.toggle("bactive_burger"); // burger
}

// Count child's element(s) of a given node
function countChild(parent, children = "", getChildrensChildren = true) {
  var relevantChildren = 0;
  var childLength = parent.childNodes.length;
  for (var i = 0; i < childLength; i++) {
    if (parent.childNodes[i].nodeType != 3) {
      // node type != text
      if (children != "") {
        if (children == parent.childNodes[i].nodeName) relevantChildren++;
      } else {
        relevantChildren++;
      }
      if (getChildrensChildren) {
        relevantChildren += countChild(parent.childNodes[i], children);
      }
    }
  }
  return relevantChildren;
}

//!!! Run the function
navSlide();
