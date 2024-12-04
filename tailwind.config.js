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
		},
	},
},
plugins: [],
}
