// console.log(graphData);
import Chart from 'chart.js';

console.log(graphData[3])

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

const transformDataToChartData = (data) => {
    const dataCount = []
    const dataLibelle = []
    data.stats.forEach(statChoice => {
        dataLibelle.push(statChoice.libelle)
        dataCount.push(statChoice.count)
    });
    return {
        datasets: [{
            data: dataCount,
            backgroundColor: data.type === 'radar' ? getRandomColor(1) : getRandomColor(data.stats.length),
            label: data.label,
        }],
        labels: dataLibelle,
    }
}

const pieChart6 = new Chart(
    pie6, {
    type: graphData[0].type,
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'white'
            },
        },
        title: {
            display: true,
            text: graphData[0].libelle,
            color: 'white',
            fontSize: '17',
            fontColor: 'white'
        },
    },
    data: transformDataToChartData(graphData[0]),
});
const pieChart7 = new Chart(
    pie7, {
    type: graphData[1].type,
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'white'
            },
        },
        title: {
            display: true,
            text: graphData[1].libelle,
            color: 'white',
            fontSize: '17',
            fontColor: 'white'
        },
    },
    data: transformDataToChartData(graphData[1]),
});
const pieChart10 = new Chart(
    pie10, {
    type: graphData[2].type,
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'white'
            },
        },
        title: {
            display: true,
            text: graphData[2].libelle,
            color: 'white',
            fontSize: '17',
            fontColor: 'white'
        },
    },
    data: transformDataToChartData(graphData[2]),
});
const radarChart = new Chart(
    radar, {
    type: graphData[3].type,
    options: {
        legend: {
            labels: {
                fontColor: 'white'
            },
        },
        title: {
            display: true,
            text: graphData[3].libelle,
            color: 'white',
            fontSize: '17',
            fontColor: 'white'
        },
        scale: {
            gridLines: {
                color: 'rgba(255, 255, 255, .4)',
                fontColor: 'white',
            },
            ticks: {
                showLabelBackdrop: false,
                min: 0,
                max: 5,
                stepSize: 1,
                fontColor: 'white',
            },
            pointLabels: {
                fontColor: 'white'
            }
        },
    },
    data: transformDataToChartData(graphData[3]),
});
