var tour = document.getElementById("tour");
tour.addEventListener("click", executeAnnoTour);

// console.log("llegó al script de tour");

function executeAnnoTour(){

    var intro =   new Anno([

        {
          target:'#programa',
          content: "Acá podé ve el programa del evento!",
          position: "center-right"
        },
        {
          target: '#invitados',
          content: "Los invitados que vienen a dictar el curso no saben una verga, pero se visten facherazos",
          position: "center-bottom"
        },
        {
          target: '#precios',
          content: "Porque nada es gratis en la vida...",
          position: 'right'
        }

    ]);
    intro.show();
};

