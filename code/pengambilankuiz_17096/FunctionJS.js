function printContent(p1){
			var restorepage = document.body.innerHTML;
			var printcontent = document.getElementById(p1).innerHTML;
			document.body.innerHTML = printcontent;
			window.print();
			document.body.innerHTML = restorepage;
		}
		