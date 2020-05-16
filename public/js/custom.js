// Initializing TinyMCE for all Textarea
tinymce.init({
    selector: 'textarea'
})

// Profile Edit Enable Disable Toggler
let profileIsEditable = false
$("#editProfileToggle").on("click", function () {
    if(profileIsEditable){
        $("#profileForm input").each(function () {
            $(this).attr("readonly", true)
            $("#editProfileToggle").removeClass('fa-arrow-left').addClass('fa-edit').removeClass('text-danger').addClass('text-primary')
        })
        profileIsEditable = false
    }else{
        $("#profileForm input").removeAttr("readonly")
        $("#editProfileToggle").removeClass('fa-edit').addClass('fa-arrow-left').removeClass('text-primary').addClass('text-danger')
        profileIsEditable = true
    }
    $("#updateProfile").toggleClass('d-none')
})
