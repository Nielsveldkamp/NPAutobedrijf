document.addEventListener("DOMContentLoaded", () => {
              
    fetch('/getSearchbar', {
                method: 'post',
                body: new FormData(),
                headers: {
                    'url': '/getSearchbar',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                }
        })
        .then(res => res.json()) // convert 
        .then(json => {

        const types = json.values.types;
        const brandstoffen = json.values.brandstoffen;
        const carrosserieen = json.values.carrosseries;

        const merkSelect = document.querySelector('#merk')
        
            merkSelect.addEventListener('change' ,(event) => {
                for( var merk in types){
                    // run for every different brand
                    
                    // if model/type not in brand {add class hiddenSelect}
                    let typeOptions = document.querySelectorAll('.'+merk)
                    if( merk != merkSelect.value && merkSelect.value != ""){
                        for (let typeOption of typeOptions) {
                            typeOption.classList.add('hiddenSelect');
                            typeOption.disabled = true;
                        }
                    }
                    else{
                        for (let typeOption of typeOptions) {
                            typeOption.classList.remove('hiddenSelect');
                            typeOption.disabled = false;
                        }
                    }

                    var merkBrandstoffen=[]
                    if(merk == merkSelect.value){
                        for(auto in types[merk] ){
                            // get all brandstof types for every auto type in brand
                                merkBrandstoffen.push(types[merk][auto].brandstof);
                        }
                    merkBrandstoffen =  Array.from(new Set(merkBrandstoffen));//  makes new array from unique unique brandstof
                    
                    // als brandstof niet gebruikt word door het gekozen merk {add class disabledSelect and set option to disabled}
                    for(brandstof in brandstoffen){
                        let brandstofOption = document.querySelector('.'+brandstof)
                            if( !merkBrandstoffen.includes(brandstof) && merkSelect.value != ""){
                                brandstofOption.classList.add('disabledSelect');
                                brandstofOption.disabled = true;
                            }
                            else{
                                brandstofOption.classList.remove('disabledSelect');
                                brandstofOption.disabled = false;
                            }
                        }
                    }
                    
                    var merkCarrosserieen=[]
                    if(merk == merkSelect.value){
                        for(auto in types[merk] ){
                            // get all carrosserie types for every auto type in brand
                            merkCarrosserieen.push(types[merk][auto].carrosserie);
                        }
                        merkCarrosserieen =  Array.from(new Set(merkCarrosserieen));// makes new array from unique carrosserieen
                    
                    // als carrosserie niet gebruikt word door het gekozen merk {add class disabled select and set option to disabled}
                    for(carrosserie in carrosserieen){
                        let carrosserieOption = document.querySelector('.'+carrosserie)
                            if( !merkCarrosserieen.includes(carrosserie) && merkSelect.value != ""){
                                carrosserieOption.classList.add('disabledSelect');
                                carrosserieOption.disabled = true;
                            }
                            else{
                                carrosserieOption.classList.remove('disabledSelect');
                                carrosserieOption.disabled = false;
                            }
                        }
                    }
                }
            })
        }); 
    });