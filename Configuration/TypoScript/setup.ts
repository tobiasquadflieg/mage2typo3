
plugin.tx_mage2typo3_product {
    view {
        templateRootPaths.0 = EXT:{extension.extensionKey}/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_mage2typo3_product.view.templateRootPath}
        partialRootPaths.0 = EXT:mage2typo3/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_mage2typo3_product.view.partialRootPath}
        layoutRootPaths.0 = EXT:mage2typo3/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_mage2typo3_product.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_mage2typo3_product.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

# these classes are only used in auto-generated templates
plugin.tx_mage2typo3._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-mage2typo3 table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-mage2typo3 table th {
        font-weight:bold;
    }

    .tx-mage2typo3 table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)

# Module configuration
module.tx_mage2typo3_tools_mage2typo3importconfiguration {
    persistence {
        storagePid = {$module.tx_mage2typo3_importconfiguration.persistence.storagePid}
    }
    view {
        templateRootPaths.0 = EXT:{extension.extensionKey}/Resources/Private/Backend/Templates/
        templateRootPaths.1 = {$module.tx_mage2typo3_importconfiguration.view.templateRootPath}
        partialRootPaths.0 = EXT:mage2typo3/Resources/Private/Backend/Partials/
        partialRootPaths.1 = {$module.tx_mage2typo3_importconfiguration.view.partialRootPath}
        layoutRootPaths.0 = EXT:mage2typo3/Resources/Private/Backend/Layouts/
        layoutRootPaths.1 = {$module.tx_mage2typo3_importconfiguration.view.layoutRootPath}
    }
}

# Module configuration
module.tx_mage2typo3_web_mage2typo3product {
    persistence {
        storagePid = {$module.tx_mage2typo3_product.persistence.storagePid}
    }
    view {
        templateRootPaths.0 = EXT:{extension.extensionKey}/Resources/Private/Backend/Templates/
        templateRootPaths.1 = {$module.tx_mage2typo3_product.view.templateRootPath}
        partialRootPaths.0 = EXT:mage2typo3/Resources/Private/Backend/Partials/
        partialRootPaths.1 = {$module.tx_mage2typo3_product.view.partialRootPath}
        layoutRootPaths.0 = EXT:mage2typo3/Resources/Private/Backend/Layouts/
        layoutRootPaths.1 = {$module.tx_mage2typo3_product.view.layoutRootPath}
    }
}
