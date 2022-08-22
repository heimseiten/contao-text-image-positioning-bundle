document.addEventListener( 'DOMContentLoaded', function () {    
    if ( document.getElementById('ctrl_textImagePositioning') ) {
        document.querySelector('#ctrl_floating td:nth-child(1)').style.transition = "opacity 1s ease-in-out"
        document.querySelector('#ctrl_floating td:nth-child(2)').style.transition = "opacity 1s ease-in-out"
        document.querySelector('#ctrl_floating td:nth-child(3)').style.transition = "opacity 1s ease-in-out"
        document.querySelector('#ctrl_floating td:nth-child(4)').style.transition = "opacity 1s ease-in-out"
        
        controlIcons(document.getElementById('ctrl_textImagePositioning').value)
        document.getElementById('ctrl_textImagePositioning').addEventListener('change', function handleChange(event) {
            controlIcons(event.target.value)
        })
    }
})    
function controlIcons(selection) {
    switch (selection) {
        case '-':
            setCss('1','1','1','1')
            break
        case 'centerImage':
            setCss('1','0.1','0.1','1')
            break
        case 'imageBesideTextCentered':
            setCss('0.1','1','1','0.1')
            break
        case 'textBesideCroppedImage':
            setCss('0.1','1','1','0.1')
            break
        case 'textBesideCroppedFullWidhImage':
            setCss('0.1','1','1','0.1')
            break
        case 'fullWidthImageBackground':
            setCss('0.1','0.1','0.1','0.1')
            break
        default:
            setCss('1','1','1','1')
      }    
}
function setCss(first,second,third,fourth) {
    document.querySelector('#ctrl_floating td:nth-child(1)').style.opacity = first
    document.querySelector('#ctrl_floating td:nth-child(2)').style.opacity = second
    document.querySelector('#ctrl_floating td:nth-child(3)').style.opacity = third
    document.querySelector('#ctrl_floating td:nth-child(4)').style.opacity = fourth
}