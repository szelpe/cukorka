$(document).ready(function(){
    $('[name=rateselector]').change(function(){
        $.post(
            '/index.php/ajax/rate_homework',
            {homework_id: eval(this.id), rate: this.value},
            function(data) {
                alert(data);
                $('#messages-outer').css('display', 'block');
                $('#messages').html(data);
            }
        );
    });
});