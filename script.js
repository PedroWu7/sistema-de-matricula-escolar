const botoesParticipar = document.querySelectorAll(".btn-participar");
const nivelAcesso = document.getElementById("nivel-acesso").dataset.valor;
console.log(nivelAcesso);

botoesParticipar.forEach((botao) => {
  botao.addEventListener("click", (event) => {
    event.preventDefault(); // evita o comportamento padrão do link
    if(nivelAcesso === "visitante") {
      alert("Faça login ou se cadastre para participar!");
    } else {
      alert("Sucesso!");
    }
  });
});
