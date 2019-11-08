// ---HANDLING AJAX ERROR
/*
error: function(jqXHR, textStatus){
  getErrorAjax(textStatus);
}
*/
function getErrorAjax(textStatus){
  if(textStatus == 0){
    alert("Tidak Ada Koneksi");
  }
  else if(textStatus == 404){
    alert("Request Page Tidak Ditemukan [404]");
  }
  else if(textStatus == 500){
    alert("Internal Server Error [500]");
  }
  else if(textStatus == 'timeout'){
    alert("ERROR Request Time Out");
  }
  else if(textStatus == 'abort'){
    alert("Request Aborted");
  }
  else if(textStatus == 'parsererror'){
    alert("Internal Server Error");
  }
}

// ---INPUT NUMBER ONLY
// onkeypress="return isNumber(event)"
function isNumber(evt){
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}

// ---OPEN IN NEW TAB
// onClick="windowOpen('lampiran/file/', 'CONTOH.pdf')"
function windowOpen(forlderName, fileName){
  var d = new Date();
  window.open("<?php echo HOSTNAME();?>/"+forlderName+"/"+fileName+"?"+d.getTime(),
  "stream",
  "width=780,height=600,scrollbars=yes,menubar=no,statusbar=no, toolbar=no,resizable=no "
  );
}

// ---SHOW IMAGE SEBELUM UPLOAD
// <input type="file" name="foto" id="foto" class="upload" accept="image/jpeg" onchange="getImageShow(this, '#foto');">
function getImageShow(inputFile, idShow) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e){
      $(idShow)
        .attr('src', e.target.result)
        .width(auto)
        .height(auto);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

// --- HITUNG UMUR SEKARANG
// calculateAge(dateFormat)
function calculateAge(birthDate) {
  var diff_ms = Date.now() - birthDate.getTime();
  var age_dt = new Date(diff_ms);

  return Math.abs(age_dt.getUTCFullYear() - 1970);
}

// --- FORMAT KOMA SETIAP 3 DIGIT ANGKA
// numberFormat(data.OTR)
function numberFormat(value){
  var string = value.toString();
	var sisa = string.length % 3;
	var result 	= string.substr(0, sisa);
	var ribuan 	= string.substr(sisa).match(/\d{3}/g);

  if (ribuan) {
  	separator = sisa ? ',' : '';
  	result += separator + ribuan.join(',');
  }

  return result;
}

// --- REPLACE OBJECT JSON JIKA NILAI NULL
// isNull(data.tanggallagir, '-')
function isNull(parameter, replace){
  return (parameter == null) ? replace : parameter;
}


// --- INPUT NOMINAL DENGAN 3 DIGIT ANGKA KOMA
// onkeyup="javascript:this.value=Comma(this.value);"
function Comma(Num) {
    Num += '';
    Num = Num.replace(/,/g, '');
    x = Num.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d)((\d{3}?)+)$/;
    while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
    return x1 + x2;
}
