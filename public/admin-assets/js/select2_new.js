$(document).ready(function () {
    const $tagsInput = $("#tags");
    const $selectTags = $("#select_tags");
    const $form = $("#form");
    const defaultTags = $tagsInput.val();

    $selectTags.select2({
        placeholder: "لطفا تگ های خود را وارد نمایید",
        tags: true,
        width: "100%",
        allowClear: true,
    });

    // -----------------------------
    // Load existing tags
    // -----------------------------
    if (defaultTags) {
        const tags = defaultTags
            .split(",")
            .map((tag) => tag.trim())
            .filter((tag) => tag.length > 0);

        tags.forEach(function (tag) {
            if ($selectTags.find("option[value='" + tag + "']").length === 0) {
                const option = new Option(tag, tag, true, true);
                $selectTags.append(option);
            }
        });

        $selectTags.val(tags).trigger("change");
    }

    // -----------------------------
    // Sync Select2 -> Hidden Input
    // -----------------------------
    function syncTags() {
        const selectedTags = $selectTags.val();

        if (selectedTags && selectedTags.length > 0) {
            $tagsInput.val(selectedTags.join(","));
        } else {
            $tagsInput.val("");
        }
    }

    $selectTags.on("change", function () {
        syncTags();
    });

    // -----------------------------
    // Form Submit
    // -----------------------------
    $form.on("submit", function () {
        syncTags();
    });
});
