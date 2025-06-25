  window.CKEditorManager = {
            instances: {},
            findEditors: function() {
                return document.querySelectorAll('textarea.ckeditor');
            },
            destroyEditor: function(editorId) {
                if (CKEDITOR.instances[editorId]) {
                    CKEDITOR.instances[editorId].destroy(true);
                    delete this.instances[editorId];
                }
            },
            createEditor: function(textarea) {
                const editorId = textarea.id;
                if (!editorId) return;
                this.destroyEditor(editorId);
                CKEDITOR.replace(editorId, {
                    height: 200,
                    removePlugins: 'uploadimage,uploadwidget,filetools,filebrowser,image,pastetools,pastefromword,pastefromgdocs,pastefromlibreoffice,pastetext,anchor',
                    on: {
                        instanceReady: function() {}
                    }
                });
                this.instances[editorId] = true;
            },
            initializeAll: function() {
                const textareas = this.findEditors();
                textareas.forEach((textarea) => {
                    this.createEditor(textarea);
                });
            },
            delayedInit: function(delay = 300) {
                setTimeout(() => {
                    this.initializeAll();
                }, delay);
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            CKEditorManager.delayedInit(500);
        });

        document.addEventListener('livewire:load', function() {
            CKEditorManager.delayedInit(300);
        });

        document.addEventListener('livewire:update', function() {
            CKEditorManager.delayedInit(200);
        });

        window.addEventListener('init-ckeditor-amenities', function() {
            CKEditorManager.delayedInit(100);
        });

        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                CKEditorManager.delayedInit(100);
            }
        });
