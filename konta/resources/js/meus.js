/*** CPF formatation ***/
function cpfChange(cpfValue) {
  var numeric = cpfValue.replace(/[^0-9]+/g, '');
  var cpfLength = numeric.length;

  var partOne = numeric.slice(0, 3) + ".";
  var partTwo = numeric.slice(3, 6) + ".";
  var partThree = numeric.slice(6, 9) + "-";

  var cpfInput = document.getElementById("cpfInput"); // here is the CPF ID of the input

  if (cpfLength < 4) {
    cpfInput.value = numeric;
  } else if (cpfLength >= 4 && cpfLength < 7) {
    var formatCPF = partOne +
      numeric.slice(3);
    cpfInput.value = formatCPF;
  } else if (cpfLength >= 7 && cpfLength < 10) {
    var formatCPF = partOne +
      partTwo +
      numeric.slice(6);
    cpfInput.value = formatCPF;
  } else if (cpfLength >= 10 && cpfLength < 12) {
    var formatCPF = partOne +
      partTwo +
      partThree +
      numeric.slice(9);
    cpfInput.value = formatCPF;
  } else if (cpfLength >= 12) {
    var formatCPF = partOne +
      partTwo +
      partThree +
      numeric.slice(9, 11);
    cpfInput.value = formatCPF;
  }
}
//modeda



String.prototype.reverse = function () {
  return this.split('').reverse().join('');
};

function mascaraMoeda(campo, evento) {
  var tecla = (!evento) ? window.event.keyCode : evento.which;
  var valor = campo.value.replace(/[^\d]+/gi, '').reverse();
  var resultado = "";
  var mascara = "##.###.###,##".reverse();
  for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
    if (mascara.charAt(x) != '#') {
      resultado += mascara.charAt(x);
      x++;
    } else {
      resultado += valor.charAt(y);
      y++;
      x++;
    }
  }
  campo.value = resultado.reverse();
}


/* Máscaras ER */
function mascara(o, f) {
  v_obj = o
  v_fun = f
  setTimeout("execmascara()", 1)
}
function execmascara() {
  v_obj.value = v_fun(v_obj.value)
}
function mtel(v) {
  v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
  v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
  v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
  return v;
}
function id(el) {
  return document.getElementById(el);
}
window.onload = function () {
  id('telefone').onkeyup = function () {
    mascara(this, mtel);
  }
}


