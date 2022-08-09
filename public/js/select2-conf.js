/**
 * For select2 configuration for tag
 * some variable need declare on top of this script
 */

$(document).ready(function () {
    $("#tag")
        .select2({
            tags: true,
            tokenSeparators: [",", " "],
            createTag: function (params) {
                console.log({ params });
                let term = $.trim(params.term);
                if (term === "") {
                    return null;
                }
                return {
                    id: term,
                    text: "Create tag : <strong>" + term + "</strong>",
                    newTag: true, // add additional parameters
                };
            },
            insertTag: function (data, tag) {
                data.push(tag);
            },
            escapeMarkup: function (markup) {
                return markup;
            },
        })
        // every single select will call this function
        .on("select2:select", function (e) {
            // if the tag is new, create new one and append to the option
            if (e.params.data.newTag) {
                // fetch to create tag
                fetch("/dashboard/tags", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        tag_name: e.params.data.id,
                        _token: csrf_token,
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        // if success, append option with data from the api
                        $(this)
                            .find('[value="' + e.params.data.id + '"]')
                            .replaceWith(
                                '<option selected value="' +
                                    data.id +
                                    '">' +
                                    data.name +
                                    "</option>"
                            );
                    })
                    // error for development
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            }
        });
});
