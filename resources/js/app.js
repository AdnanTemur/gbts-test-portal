import './bootstrap';
import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';

window.Alpine = Alpine;
Alpine.start();

window.ApexCharts = ApexCharts;

// Section timer component
window.initSectionTimer = function(endTime) {
    return {
        timeRemaining: 0,
        interval: null,
        
        init() {
            this.calculateTimeRemaining();
            this.interval = setInterval(() => {
                this.calculateTimeRemaining();
                
                if (this.timeRemaining <= 0) {
                    clearInterval(this.interval);
                    this.autoSubmitSection();
                }
            }, 1000);
        },
        
        calculateTimeRemaining() {
            const now = new Date().getTime();
            const end = new Date(endTime).getTime();
            this.timeRemaining = Math.max(0, Math.floor((end - now) / 1000));
        },
        
        formatTime() {
            const minutes = Math.floor(this.timeRemaining / 60);
            const seconds = this.timeRemaining % 60;
            return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        },
        
        isWarning() {
            return this.timeRemaining <= 60; // Last minute warning
        },
        
        autoSubmitSection() {
            document.getElementById('section-form').submit();
        }
    }
};

// Save answer via AJAX
window.saveAnswer = function(token, questionId, data) {
    fetch(`/test/answer/${token}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            question_id: questionId,
            ...data
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Answer saved');
        }
    })
    .catch(error => console.error('Error:', error));
};
