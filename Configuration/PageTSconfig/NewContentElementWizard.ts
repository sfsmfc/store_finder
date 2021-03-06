mod.wizards.newContentElement.wizardItems {
	plugins {
		elements {
			storefinder_map {
				iconIdentifier = store-finder-plugin
				title = LLL:EXT:store_finder/Resources/Private/Language/locallang_be.xml:pi1_title_map
				description = LLL:EXT:store_finder/Resources/Private/Language/locallang_be.xml:pi1_description_map
				tt_content_defValues {
					CType = list
					list_type = storefinder_map
				}
			}
			storefinder_show {
				iconIdentifier = store-finder-plugin
				title = LLL:EXT:store_finder/Resources/Private/Language/locallang_be.xml:pi1_title_show
				description = LLL:EXT:store_finder/Resources/Private/Language/locallang_be.xml:pi1_description_show
				tt_content_defValues {
					CType = list
					list_type = storefinder_show
				}
			}
		}
		show = *
	}
}