// console.log(graphData);
import Chart from 'chart.js';

const pie6 = document.getElementById('pie-6').getContext('2d')
const pie7 = document.getElementById('pie-7').getContext('2d')
const pie10 = document.getElementById('pie-10').getContext('2d')
const radar = document.getElementById('radar').getContext('2d')

//max 7 colors
const getRandomColor = (number) => {
    const returnedColor = []
    let colorArray = [
        '#cd80d7',
        '#86c1a2',
        '#eee72b',
        '#7b5181',
        '#26abab',
        '#4526ab',
    ]
    if(number === 1){
        const randomNumber = Math.floor(Math.random() * Math.floor(colorArray.length))
        return colorArray[randomNumber]
    }
    else{
        for (let index = 0; index < number; index++) {
            if(colorArray.length > 0){
                const randomNumber = Math.floor(Math.random() * Math.floor(colorArray.length))
                returnedColor.push(colorArray[randomNumber])
                colorArray = colorArray.filter((color) => color !== colorArray[randomNumber])
            }
        }
    }
    return returnedColor
}

const pieChart6 = new Chart(
    pie6, {
    type: 'pie',
    options: {
        title: {
            display: true,
            text: 'Chart.js Radar Chart',
            color: 'white',
            fontSize: '17',
            fontColor: 'white'
        },
    },
    data:{
        datasets: [{
            data: [10, 20, 30],
            backgroundColor: getRandomColor(3),
        }],
        labels: [
            'Red',
            'Yellow',
            'Blue'
        ],
    }
});
const pieChart7 = new Chart(
    pie7, {
    type: 'pie',
    options: {
        title: {
            display: true,
            text: 'Chart.js Radar Chart',
            color: 'white',
            fontSize: '17',
            fontColor: 'white'
        },
    },
    data: {
        datasets: [{
            data: [10, 20, 30],
            backgroundColor: getRandomColor(3),
        }],
        labels: [
            'Red',
            'Yellow',
            'Blue'
        ],
    }
});
const pieChart10 = new Chart(
    pie10, {
    type: 'pie',
    options: {
        title: {
            display: true,
            text: 'Chart.js Radar Chart',
            color: 'white',
            fontSize: '17',
            fontColor: 'white'
        },
    },
    data: {
        datasets: [{
            data: [10, 20, 30],
            backgroundColor: getRandomColor(3),
        }],
        labels: [
            'Red',
            'Yellow',
            'Blue'
        ],
    }
});
const radarChart = new Chart(
    radar, {
    type: 'radar',
    options: {
        title: {
            display: true,
            text: 'Chart.js Radar Chart',
            color: 'white',
            fontSize: '17',
            fontColor: 'white'
        },
        scale: {
            ticks: {
                backgroundColor: 'red',
                showLabelBackdrop: false,
                stepSize: 5
            },
        },
    },
    data: {
        datasets: [{
            data: [10, 20, 30],
            label: 'test',
            backgroundColor: getRandomColor(1),
        }],
        labels: [
            'Red',
            'Yellow',
            'Blue'
        ]
    }
});
