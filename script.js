<<<<<<< Updated upstream
// Block 000.webhost.com banner
window.onload = () => {
    let el = document.querySelector('[alt="www.000webhost.com"]').parentNode.parentNode;
    el.parentNode.removeChild(el);
}
// Password visibility
function visibility() {
    var x = document.getElementById("pass1");
    var z = document.getElementById("pass2");
    
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }

    if (z.type === "password") {
        z.type = "text";
      } else {
        z.type = "password";
      }

  }

  // Go Back
  function goBack(){
    window.history.back();
  }
=======
// Block 000.webhost.com banner
window.onload = () => {
    let el = document.querySelector('[alt="www.000webhost.com"]').parentNode.parentNode;
    el.parentNode.removeChild(el);
}
// Password visibility
function visibility() {
    var x = document.getElementById("pass1");
    var z = document.getElementById("pass2");
    
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }

    if (z.type === "password") {
        z.type = "text";
      } else {
        z.type = "password";
      }

  }

  // Go Back
  function goBack(){
    window.history.back();
  }
>>>>>>> Stashed changes
