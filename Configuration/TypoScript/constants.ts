
plugin.tx_mage2typo3_mage2products {
    view {
        # cat=plugin.tx_mage2typo3_mage2products/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:mage2typo3/Resources/Private/Templates/
        # cat=plugin.tx_mage2typo3_mage2products/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:mage2typo3/Resources/Private/Partials/
        # cat=plugin.tx_mage2typo3_mage2products/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:mage2typo3/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_mage2typo3_mage2products//a; type=string; label=Default storage PID
        storagePid =
    }
}

module.tx_mage2typo3_mage2import {
    view {
        # cat=module.tx_mage2typo3_mage2import/file; type=string; label=Path to template root (BE)
        templateRootPath = EXT:mage2typo3/Resources/Private/Backend/Templates/
        # cat=module.tx_mage2typo3_mage2import/file; type=string; label=Path to template partials (BE)
        partialRootPath = EXT:mage2typo3/Resources/Private/Backend/Partials/
        # cat=module.tx_mage2typo3_mage2import/file; type=string; label=Path to template layouts (BE)
        layoutRootPath = EXT:mage2typo3/Resources/Private/Backend/Layouts/
    }
    persistence {
        # cat=module.tx_mage2typo3_mage2import//a; type=string; label=Default storage PID
        storagePid =
    }
}

module.tx_mage2typo3_mage2products {
    view {
        # cat=module.tx_mage2typo3_mage2products/file; type=string; label=Path to template root (BE)
        templateRootPath = EXT:mage2typo3/Resources/Private/Backend/Templates/
        # cat=module.tx_mage2typo3_mage2products/file; type=string; label=Path to template partials (BE)
        partialRootPath = EXT:mage2typo3/Resources/Private/Backend/Partials/
        # cat=module.tx_mage2typo3_mage2products/file; type=string; label=Path to template layouts (BE)
        layoutRootPath = EXT:mage2typo3/Resources/Private/Backend/Layouts/
    }
    persistence {
        # cat=module.tx_mage2typo3_mage2products//a; type=string; label=Default storage PID
        storagePid =
    }
}
