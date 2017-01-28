// présentation 1
departements = [];
departements[0] = "01 - Ain";
departements[1] = "02 - Aisne";
departements[2] = "03 - Allier";
departements[3] = "04 - Alpes de Haute Provence";
departements[4] = "05 - Hautes Alpes";
departements[5] = "06 - Alpes Maritimes";
departements[6] = "07 - Ardèche";
departements[7] = "08 - Ardennes";
departements[8] = "09 - Ariège";
departements[9] = "10 - Aube";
departements[10] = "11 - Aude";
departements[11] = "12 - Aveyron";
departements[12] = "13 - Bouches du Rhône";
departements[13] = "14 - Calvados";
departements[14] = "15 - Cantal";
departements[15] = "16 - Charente";
departements[16] = "17 - Charente Maritime";
departements[17] = "18 - Cher";
departements[18] = "19 - Corrèze";
/*departements["2A"] = "2A - Corse du Sud";
departements["2B"] = "2B - Haute Corse";*/
departements[19] = "20 - Corse";
departements[20] = "21 - Côte d'Or";
departements[21] = "22 - Côtes d'Armor";
departements[22] = "23 - Creuse";
departements[23] = "24 - Dordogne";
departements[24] = "25 - Doubs";
departements[25] = "26 - Drôme";
departements[26] = "27 - Eure";
departements[27] = "28 - Eure et Loir";
departements[28] = "29 - Finistère";
departements[29] = "30 - Gard";
departements[30] = "31 - Haute Garonne";
departements[31] = "32 - Gers";
departements[32] = "33 - Gironde";
departements[33] = "34 - Hérault";
departements[34] = "35 - Ille et Vilaine";
departements[35] = "36 - Indre";
departements[36] = "37 - Indre et Loire";
departements[37] = "38 - Isère";
departements[38] = "39 - Jura";
departements[39] = "40 - Landes";
departements[40] = "41 - Loir et Cher";
departements[41] = "42 - Loire";
departements[42] = "43 - Haute Loire";
departements[43] = "44 - Loire Atlantique";
departements[44] = "45 - Loiret";
departements[45] = "46 - Lot";
departements[46] = "47 - Lot et Garonne";
departements[47] = "48 - Lozère";
departements[48] = "49 - Maine et Loire";
departements[49] = "50 - Manche";
departements[50] = "51 - Marne";
departements[51] = "52 - Haute Marne";
departements[52] = "53 - Mayenne";
departements[53] = "54 - Meurthe et Moselle";
departements[54] = "55 - Meuse";
departements[55] = "56 - Morbihan";
departements[56] = "57 - Moselle";
departements[57] = "58 - Nièvre";
departements[58] = "59 - Nord";
departements[59] = "60 - Oise";
departements[60] = "61 - Orne";
departements[61] = "62 - Pas de Calais";
departements[62] = "63 - Puy de Dôme";
departements[63] = "64 - Pyrénées Atlantiques";
departements[64] = "65 - Hautes Pyrénées";
departements[65] = "66 - Pyrénées Orientales";
departements[66] = "67 - Bas Rhin";
departements[67] = "68 - Haut Rhin";
departements[68] = "69 - Rhône";
departements[69] = "70 - Haute Saône";
departements[70] = "71 - Saône et Loire";
departements[71] = "72 - Sarthe";
departements[72] = "73 - Savoie";
departements[73] = "74 - Haute Savoie";
departements[74] = "75 - Paris";
departements[75] = "76 - Seine Maritime";
departements[76] = "77 - Seine et Marne";
departements[77] = "78 - Yvelines";
departements[78] = "79 - Deux Sèvres";
departements[79] = "80 - Somme";
departements[80] = "81 - Tarn";
departements[81] = "82 - Tarn et Garonne";
departements[82] = "83 - Var";
departements[83] = "84 - Vaucluse";
departements[84] = "85 - Vendée";
departements[85] = "86 - Vienne";
departements[86] = "87 - Haute Vienne";
departements[87] = "88 - Vosges";
departements[88] = "89 - Yonne";
departements[89] = "90 - Territoire de Belfort";
departements[90] = "91 - Essonne";
departements[91] = "92 - Hauts de Seine";
departements[92] = "93 - Seine St Denis";
departements[93] = "94 - Val de Marne";
departements[94] = "95 - Val d'Oise";
//departements[96] = "97 - DOM";

function size(){
	$("#flash-message").css("margin-top", $(".logo-pic").width() / 2);
}

//Some js here
$(document).ready(function(){
	//console.log('start');
	$("#user-name").height();
	$(".img-user").css("height", $("#user-name").height() - 0.5);

	size();

	$('#postal_code').bind('input propertychange', function() {
		var dptText = (this.value).toString();
		var number = parseInt(this.value);
		if(dptText.length > 1 && dptText.length < 3){
			if(typeof number === "number" && number != NaN){
				this.value = departements[this.value - 1];
			}
			if(this.value == 'undefined'){
				this.value = "";
			}
		}
		if(dptText.length >= 3){
			var notMatch = 0;
			for(var i = 0; i < departements.length; i++){
				if (this.value != departements[i]){
					notMatch++;
				}
			}
			if(notMatch == departements.length){
				this.value = "";
			}
		}
	});
	$('#codepostal').bind('input propertychange', function() {
		var departement = $("#departement");
		var dptText = (this.value).toString();
		var number = parseInt(this.value);
		if(dptText.length > 1 && dptText.length < 3){
			if(typeof number === "number" && number != NaN){
				departement.val(departements[this.value - 1]);
			}
			if(this.value == 'undefined'){
				departement.val("");
			}
		}
		if(dptText.length < 2){
			departement.val("");
		}
	});
	$("form").submit(function() {
	    $("input").removeAttr("disabled");
	});
	document.getElementById("avatars").onchange = function(){
		var pieces = this.value.split('\\');
		var filename = pieces[pieces.length-1];
	    $("#file-text").html(filename);
	};
});