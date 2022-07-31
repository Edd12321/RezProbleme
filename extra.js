const tog = document.getElementById("cbox1");
const htm = document.body;

function
kmode()
{
	const i = tog.checked;
	htm.classList.toggle("dark", i);
	localStorage.setItem("theme", i ? "dark" : '');
}

tog.checked = localStorage.getItem("theme");
tog.addEventListener("input", tog);
kmode();
