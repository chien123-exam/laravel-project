const radioButtons = document.querySelectorAll('input[type="radio"][name="locations"]');
function handleRadioClick(e) {
    if (e.target.value == 4) {
        $('#detailInfo input').prop('disabled', true);
        $( "#detailInfo" ).addClass( "d-none");
    } else {
        $('#detailInfo input').prop('disabled', false);
        $( "#detailInfo" ).removeClass( "d-none");
    }
}

// Lặp qua từng nút radio và gắn sự kiện click và change
radioButtons.forEach(button => {
    button.addEventListener('click', handleRadioClick);
    button.addEventListener('change', handleRadioClick);
});
