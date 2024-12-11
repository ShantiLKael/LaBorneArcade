/** @type {import('tailwindcss').Config} */
module.exports = {
content: [
	"./app/Views/**/*.php"
],
theme: {
	extend: {
		colors: {
			'deep-blue'  : '#0D1220',
			'dark-blue'  : '#0e1424',
			'medium-blue': '#161C2D',
			'light-blue' : '#243240',
			'dark-teal'  : '#056650',
			'medium-teal': '#0A8065',
			'light-teal' : '#18CCA3',
            'rouge-pastel'  : '#f5afa5',
            'vert-pastel'   : '#c2f5a5',
            'rouge-pastelF' : '#f39a93',
            'vert-pastelF'  : '#b6f393',
            'FVert'         : '#ebf0ea',
            'FVertClair'    : '#f4f8f3',
		},
	},
},
plugins: [],
}
