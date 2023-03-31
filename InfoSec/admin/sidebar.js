document.querySelector('.collapse-btn').addEventListener("click", open);

function open() {
	let toggleSB = document.querySelector('.sidebar');
	toggleSB.classList.toggle('active');

	let toggleNB = document.querySelector('.navbar');
	toggleNB.classList.toggle('active');
	
	let toggleMain = document.querySelector('main');
	toggleMain.classList.toggle('active');
}



// $(document).ready(function () {

// 	$('.deletebtn').on('click', function () {

// 		$('#deletemodal').modal('show');

// 		$tr = $(this).closest('tr');

// 		var data = $tr.children("td").map(function () {
// 			return $(this).text();
// 		}).get();

// 		console.log(data);

// 		$('#delete_id').val(data[0]);

// 	});
// });