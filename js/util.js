// Enable checkbox to control the specific field for read only or not
function controlField(chkboxId, fieldId) {
    var chkbox = document.getElementById(chkboxId);

    chkbox.onclick = function() {
        var field = document.getElementById(fieldId);
        if (chkbox.checked) {
            field.readOnly = false;
        } else {
            field.readOnly = true;
        }
    }
}