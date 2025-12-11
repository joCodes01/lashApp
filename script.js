// let clientID = document.getElementById('clientID').value;
// console.log(clientID);

// let appClientID = document.getElementById('appClientID').value;
// console.log(appClientID);

// appClientID.textContent = clientID;

//when image is chosen in the admin form, get the image with FileReader() and display it on the page.

//TODO
//TODO
//THE TWO FUNCTIONS BELOW DO THE SAME THING! CONSOLIDATE THEM INTO ONE!

//set the cabinimage input(file upload) to imageFile variable
const imageFileAfter = document.getElementById("afterPhoto");

//listen for when a user selects a file
imageFileAfter.addEventListener("change", function () {
  //get the first file
  const image = imageFileAfter.files[0];

  //if there is a file selected
  if (image) {
    //create a file reader
    const reader = new FileReader();

    //when the reader reads the file
    reader.onload = function (event) {
      //set imagePreview variable to 'cabinimage-container img'
      const imagePreview = document.getElementById("afterPhotoImage");

      console.log("Preview element:", imagePreview);

      imagePreview.src = event.target.result;
      console.log("");
    };

    reader.readAsDataURL(image);
  }
});

const imageFileBefore = document.getElementById("beforePhoto");

//listen for when a user selects a file
imageFileBefore.addEventListener("change", function () {
  //get the first file
  const image = imageFileBefore.files[0];

  //if there is a file selected
  if (image) {
    //create a file reader
    const reader = new FileReader();

    //when the reader reads the file
    reader.onload = function (event) {
      //set imagePreview variable to 'cabinimage-container img'
      const imagePreview = document.getElementById("beforePhotoImage");

      console.log("Preview element:", imagePreview);

      imagePreview.src = event.target.result;
      console.log("");
    };

    reader.readAsDataURL(image);
  }
});
