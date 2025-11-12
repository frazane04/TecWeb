// Script base per test di collegamento

document.addEventListener("DOMContentLoaded", () => {
  console.log("JavaScript collegato correttamente!");

  const button = document.getElementById("myButton");
  if (button) {
    button.addEventListener("click", () => {
      alert("Hai cliccato il bottone! 🎉");
    });
  }
});