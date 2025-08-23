$(document).ready(function () {
    var tags_input = $('#tags');
    var select_tags = $('#select_tags');

    var default_tags = tags_input.val();
    var default_data = [];

    if(default_tags !== null && default_tags.length > 0) {
        default_data = default_tags.split(',');
    }

    select_tags.select2({
        placeholder: "لطفا تگ های خود را وارد نمایید",
        tags: true,
        width: '100%',
    });

    if(default_data.length > 0) {
        default_data.forEach(function(tag) {
            if(select_tags.find("option[value='" + tag + "']").length === 0) {
                var newOption = new Option(tag, tag, true, true);
                select_tags.append(newOption).trigger('change');
            } else {
                select_tags.val(default_data).trigger('change');
            }
        });
    }

    $('#form').submit(function (event) {
        var selectedTags = select_tags.val();
        if (selectedTags !== null && selectedTags.length > 0) {
            tags_input.val(selectedTags.join(','));
        } else {
            tags_input.val('');
        }
    });
});
