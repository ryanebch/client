// Initialisation de Flatpickr pour le calendrier
flatpickr("#appointmentDate", {
    enableTime: false, // Only date selection allowed
    locale: "fr", // Use French locale
    dateFormat: "Y-m-d", // Full date format (Year-Month-Day)
    minDate: "today", // Disable past dates
    disable: [
        (date) => date.getDay() === 5 || date.getDay() === 6 // Disable Fridays (5) and Saturdays (6)
    ],
    firstDayOfWeek: 6, // Start the week on Sunday
    onChange: function (selectedDates) {
        const noDateMessage = document.getElementById("no-date-message");
        noDateMessage.style.display = selectedDates.length === 0 ? "block" : "none";
    },
    onReady: () => {
        const noDateMessage = document.getElementById("no-date-message");
        noDateMessage.style.display = "block";
    }
});

// Mapping doctor specialties
const doctorSpecialties = {
    "Consultation générale": ["Dr Keciour Nesma", "Dr Belhedid Ibtissem", "Dr Bensalah Meriem", "Dr Guerroumi Lynda", "Dr Bouchetara Ryane"],
    "Blanchiment dentaire": ["Dr Keciour Nesma", "Dr Belhedid Ibtissem", "Dr Bensalah Meriem"],
    "Détartrage et nettoyage": ["Dr Keciour Nesma", "Dr Belhedid Ibtissem", "Dr Guerroumi Lynda"],
    "Orthodontie": ["Dr Keciour Nesma", "Dr Bensalah Meriem", "Dr Bouchetara Ryane"],
    "Soin des caries": ["Dr Belhedid Ibtissem", "Dr Bensalah Meriem", "Dr Guerroumi Lynda"],
    "Implant dentaire": ["Dr Bensalah Meriem", "Dr Guerroumi Lynda", "Dr Bouchetara Ryane"],
    "Traitement de canal": ["Dr Bensalah Meriem", "Dr Guerroumi Lynda"],
    "Prothése dentaire": ["Dr Bensalah Meriem", "Dr Guerroumi Lynda", "Dr Bouchetara Ryane"]
};

// Update doctor options based on selected motif
function updateDoctorsBasedOnMotif() {
    const motif = document.getElementById('motif').value;
    const doctorSelect = document.getElementById('nom_docteur');

    doctorSelect.innerHTML = '<option value="" disabled selected>Choisir un médecin</option>';

    if (motif && doctorSpecialties[motif]) {
        doctorSpecialties[motif].forEach(nom_docteur => {
            const option = document.createElement('option');
            option.value = nom_docteur;
            option.textContent = nom_docteur;
            doctorSelect.appendChild(option);
        });
    }
}

// Fetch booked slots from the backend
async function fetchBookedSlots(doctor, date) {
    try {
        const response = await fetch(`getBookedSlots.php?doctor=${encodeURIComponent(doctor)}&date=${encodeURIComponent(date)}`);
        const text = await response.text();
        console.log("Raw response from server:", text);

        try {
            const data = JSON.parse(text);
            console.log("Parsed JSON Response:", data);
            return data;
        } catch (jsonError) {
            console.error("JSON Parsing Error:", jsonError);
            return [];
        }
    } catch (error) {
        console.error("Erreur lors de la récupération des créneaux réservés:", error);
        return [];
    }
}

// Generate time slots based on selected doctor and date
async function generateTimeSlots() {
    const timeSlots = document.querySelector(".slots");
    timeSlots.innerHTML = ""; // Clear previous slots

    const doctor = document.getElementById("nom_docteur").value;
    const date = document.getElementById("appointmentDate").value;

    if (!doctor || !date) {
        console.log("Doctor or date is missing. Cannot generate time slots.");
        return;
    }

    const bookedSlots = await fetchBookedSlots(doctor, date);
    const times = ["08:00:00", "09:00:00", "10:00:00", "11:00:00", "13:00:00", "14:00:00"];
    const availableSlots = times.filter(time => !bookedSlots.includes(time));

    if (availableSlots.length === 0) {
        console.log("No available slots for this doctor on this date.");
        return;
    }

    availableSlots.forEach((availableSlot) => {
        const button = document.createElement("button");
        button.type = "button";
        button.textContent = availableSlot.substring(0, 5); // Display only "HH:MM"
        button.className = "time-slot"; // Add a class for styling

        button.addEventListener("click", () => {
            document.querySelectorAll(".slots button").forEach(btn => btn.classList.remove("selected"));
            button.classList.add("selected");
            document.getElementById("selectedTime").value = availableSlot;
        });

        timeSlots.appendChild(button);
    });
}

// Attach event listeners
document.getElementById('motif').addEventListener('change', updateDoctorsBasedOnMotif);
document.getElementById('nom_docteur').addEventListener('change', generateTimeSlots);
document.getElementById('appointmentDate').addEventListener('change', generateTimeSlots);

// Populate doctors on page load
updateDoctorsBasedOnMotif();
