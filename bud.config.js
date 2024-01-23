/** @param {import('@roots/bud').Bud} bud */

export default async (bud) => {
	bud.setPath({
		"@src": "resources/assets/",
		"@dist": "public",
	})

	bud.entry({
		'app': ['scripts/app.js', 'styles/app.scss'],
		'admin': ['scripts/admin.js', 'styles/admin.scss'],
	})

	bud.runtime(false)
}  
