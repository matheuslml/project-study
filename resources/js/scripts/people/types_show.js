let selectType = $('select[name=personable_type]');

function loadTypes(obj) {
    let idType = $(obj).val();
    if (idType === 'pf') {
        $(".pf").show();
        $(".pj").hide();
        $(".others").show();
    } else if (idType === 'pj') {
        $(".pf").hide();
        $(".pj").show();
        $(".others").show();
    } else {
        $(".pf").hide();
        $(".pj").hide();
        $(".others").hide();
    }

}
if (selectType.length) {
    selectType.on('change', function() {
        loadTypes(this)
    });

    $(document).ready(function() {
        loadTypes(selectType)
    });
}