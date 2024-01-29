import { WebCamHelper } from "./webcamhelper.js";

class WebCamApp {
  constructor() {
    this.imageForm = document.getElementById("imageForm");
    this.downloadlink = document.getElementById("link");
    this.button = document.querySelector('input[type="submit"]');
    this.qrcode = document.getElementById("qrcode");
    this.canvas_id = document.getElementById("canvas");
    this.timerDisplay = document.createElement("div");
    this.timerDisplay.classList.add("timer");
    this.linkuguu = document.getElementById("link_uguu");
    this.restartbtn = document.getElementById("restart-btn");
    this.webapi = new WebCamHelper();
  }

  capturePhoto() {
    this.timerDisplay.innerHTML = "Timer: 5 seconds";
    let count = 5;
    const timer = setInterval(() => {
      count--;
      this.timerDisplay.innerHTML = `Timer: ${count} seconds`;
      if(count === 0){
        clearInterval(timer);
        this.timerDisplay.style.display = "none";
        this.webapi.GrabFrame(async (imageBitmap) => {
          let imageBlob = await this.webapi.GrabFrameToCanvas(imageBitmap, "canvas");
          this.sendBlob(imageBlob);
        });
      }
    }, 1000);
  }

  sendBlob(imageBlob) {
    let formData = new FormData();
    formData.append("image", imageBlob, "image.png");
    let options = {
      method: "POST",
      body: formData,
    };
    
    fetch("imagereceive.php", options)
      .then((response) => response.json())
      .then((json) => this.showLink(json));
  }

  showLink(json) {
    this.downloadlink.innerHTML = json.downloadlink;
    document.getElementById("link").href = json.downloadlink;
    this.linkuguu.innerHTML = json.upload_path;
    this.linkuguu.href = json.upload_path;
    let qr_link = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${this.linkuguu.innerHTML}`;
    fetch(qr_link)
      .then((response) => response.blob())
      .then((blob) => {
        this.qrcode.src = URL.createObjectURL(blob);
      });
    this.button.style.display = "none";
    this.qrcode.style.display = "block";
    this.downloadlink.style.display = "block";
    this.canvas_id.style.display = "block";
    this.linkuguu.style.display = "block";
    this.restartbtn.style.display = "block";
  }

  takePhotoClicked() {
    if (this.webapi.ready) {
      this.capturePhoto();
    }
  }

  init() {
    document.body.appendChild(this.timerDisplay);
    this.webapi.startApi();
    this.imageForm.addEventListener("submit", (e) => {
      e.preventDefault();
      this.takePhotoClicked();
    });
    this.restartbtn.addEventListener("click", (e) => {
    window.location.reload(true);
    });
  }
}

let app = new WebCamApp();
app.init();