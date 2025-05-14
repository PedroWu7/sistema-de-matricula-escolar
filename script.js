const botaoAdicionarCurso = document.getElementById("adicionarCurso");
const cursos = document.getElementById('cursos');

botaoAdicionarCurso.addEventListener('click', (event) => {
    var curso = document.createElement('div');
    curso.classList.add('curso');
    cursos.appendChild(curso);
});