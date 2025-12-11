const addNewClient = document.querySelector("#addNewClient");
const CRUDclient = document.querySelector("#CRUDclient");

// console.log("found at end of body:", addNewClient);

addNewClient.addEventListener("click", () => {
  console.log("the value is: ", CRUDclient);
  CRUDclient.target.value = "CREATE";
});
