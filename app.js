function popup() {
   let pop = document.querySelector('.notification');
   setTimeout(() => {
      pop.classList.add('active');
   }, 1000);
   setTimeout(() => {
      pop.classList.remove('active');
   }, 5000);
   if(pop.querySelector('span')){
      let countDwn = setInterval(() => {
         if(Number(pop.querySelector('span').innerHTML) > 0){
            pop.querySelector('span').innerHTML = pop.querySelector('span').innerHTML - 1;
         }else{
            clearInterval(countDwn);
         }
      }, 1000);
   }
}