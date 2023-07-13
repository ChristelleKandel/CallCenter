/* changer le type password en type text pour afficher le MDP */
$('.reveal').on('click', function () {
    var $pwd = $('.pwd');
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
