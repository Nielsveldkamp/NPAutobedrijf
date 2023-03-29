
    var loadFile = function(event) {
        const imageFlex = document.querySelector('.imageFlex');
        const imageFlexHeader = document.querySelector('.imageFlexHeader');
        
        if(event.target.files.length >0){
            imageFlexHeader.innerHTML = "nieuw toegevoegde afbeeldingen"
        }
        else{
            imageFlexHeader.innerHTML = ""
        }
        imageFlex.textContent = '';
        for (let index = 0; index < event.target.files.length; index++) {
            const file = event.target.files[index];
            imageDiv = document.createElement('div');
            image = document.createElement('img');
            imageDiv.classList.add("col");
            imageDiv.classList.add("mb-5");
            image.classList.add("img");
            imageDiv.appendChild(image);
            image.src = URL.createObjectURL(file);
            imageFlex.appendChild(imageDiv);
        }
    };