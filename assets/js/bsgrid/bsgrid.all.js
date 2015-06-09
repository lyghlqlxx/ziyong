/**
 * @Date March 17, 2014
 */

/**
 * String startWith.
 *
 * @param string
 * @returns {boolean}
 */
String.prototype.startWith = function (string) {
    if (string == null || string == "" || this.length == 0 || string.length > this.length) {
        return false;
    } else {
        return this.substr(0, string.length) == string;
    }
};

/**
 * String endWith.
 *
 * @param string
 * @returns {boolean}
 */
String.prototype.endWith = function (string) {
    if (string == null || string == "" || this.length == 0 || string.length > this.length) {
        return false;
    } else {
        return this.substring(this.length - string.length) == string;
    }
};

/**
 * String replaceAll.
 *
 * @param string1
 * @param string2
 * @returns {string}
 */
String.prototype.replaceAll = function (string1, string2) {
    return this.replace(new RegExp(string1, "gm"), string2);
};

function StringBuilder() {
    if (arguments.length) {
        this.append.apply(this, arguments);
    }
}
/**
 * StringBuilder.
 * Property: length
 * Method: append,appendFormat,size,toString,valueOf
 *
 * From: http://webreflection.blogspot.com/2008/06/lazy-developers-stack-concept-and.html
 * (C) Andrea Giammarchi - Mit Style License
 * @type {StringBuilder.prototype}
 */
StringBuilder.prototype = function () {
    var join = Array.prototype.join, slice = Array.prototype.slice, RegExp = /\{(\d+)\}/g, toString = function () {
        return join.call(this, "");
    };
    return {
        constructor: StringBuilder,
        length: 0,
        append: Array.prototype.push,
        appendFormat: function (String) {
            var i = 0, args = slice.call(arguments, 1);
            this.append(RegExp.test(String) ? String.replace(RegExp, function (String, i) {
                return args[i];
            }) : String.replace(/\?/g, function () {
                return args[i++];
            }));
            return this;
        },
        size: function () {
            return this.toString().length;
        },
        toString: toString,
        valueOf: toString
    };
}();


/**
 * jQuery.bsgrid v1.35 by @Baishui2004
 * Copyright 2014 Apache v2 License
 * https://github.com/baishui2004/jquery.bsgrid
 */
/**
 * require common.js, util.js.
 *
 * @author Baishui2004
 * @Date July 1, 2014
 */
(function ($) {

    $.bsgrid_export = {

        // defaults settings
        defaults: {
            url: '', // export url
            exportFileName: 'export', // export file name, not contains file suffix
            colsProperties: {
                width: 100,
                align: 'left',
                exportAttr: 'w_export',
                indexAttr: 'w_index',
                widthAttr: 'width',
                alignAttr: 'w_align'
            },
            colWidthPercentmultiplier: 14, // if set column width N%, then column width will reset N*14
            // request params name
            requestParamsName: {
                exportFileName: 'exportFileName',
                colNames: 'dataNames',
                colIndexs: 'dataIndexs',
                colWidths: 'dataLengths',
                colAligns: 'dataAligns'
            }
        },

        /**
         * do export.
         *
         * @param exportCols
         * @param exportParamsObj
         * @param settings
         */
        doExport: function (exportCols, exportParamsObj, settings) {
            if (exportParamsObj == undefined) {
                exportParamsObj = {};
            }

            var exportSettings = {};
            if (settings == undefined) {
                settings = {};
            }
            $.extend(true, exportSettings, $.bsgrid_export.defaults, settings);

            var colNames = '', colIndexs = '', colWidths = '', colAligns = '';
            for (var i = 0; i < exportCols.length; i++) {
                if ($.trim(exportCols.eq(i).attr(exportSettings.colsProperties.exportAttr)) != 'false') {
                    // column name, get form column's text(), use jquery
                    colNames = colNames + ',' + $.trim(exportCols.eq(i).text());
                    colIndexs = colIndexs + ',' + $.trim(exportCols.eq(i).attr(exportSettings.colsProperties.indexAttr));

                    var colWidthStr = $.trim(exportCols.eq(i).attr(exportSettings.colsProperties.widthAttr)).toLocaleLowerCase();
                    var colWidth = exportSettings.colsProperties.width;
                    if (isNaN(colWidthStr)) {
                        if (colWidthStr.endWith('px')) {
                            colWidth = parseInt(colWidthStr.replace('px', ''));
                        } else if (colWidthStr.endWith('%')) {
                            colWidthStr = colWidthStr.replace('%', '');
                            if (!isNaN(colWidthStr)) {
                                colWidth = exportSettings.colWidthPercentmultiplier * parseInt(colWidthStr);
                            }
                        }
                    }
                    colWidths = colWidths + ',' + colWidth;

                    var colAlign = $.trim(exportCols.eq(i).attr(exportSettings.colsProperties.alignAttr));
                    if (colAlign == '') {
                        colAlign = exportSettings.colsProperties.align;
                    }
                    colAligns = colAligns + ',' + colAlign;
                }
            }

            document.location.href = exportSettings.url + (exportSettings.url.indexOf('?') < 0 ? '?' : '&')
                + exportSettings.requestParamsName.exportFileName + '=' + encodeURIComponent(encodeURIComponent(exportSettings.exportFileName))
                + '&' + exportSettings.requestParamsName.colNames + '=' + encodeURIComponent(encodeURIComponent(colNames.substring(1)))
                + '&' + exportSettings.requestParamsName.colIndexs + '=' + colIndexs.substring(1)
                + '&' + exportSettings.requestParamsName.colWidths + '=' + colWidths.substring(1)
                + '&' + exportSettings.requestParamsName.colAligns + '=' + colAligns.substring(1)
                + (exportParamsObj.length == 0 ? '' : ('&' + $.bsgrid.param(exportParamsObj, true)));
        }

    };

})(jQuery);


/**
 * jQuery.bsgrid v1.35 by @Baishui2004
 * Copyright 2014 Apache v2 License
 * https://github.com/baishui2004/jquery.bsgrid
 */
/**
 * require common.js.
 *
 * @author Baishui2004
 * @Date August 31, 2014
 */
(function ($) {

    $.fn.bsgrid = {

        // defaults settings
        defaults: {
            dataType: 'json',
            localData: false, // values: false, json data, xml data
            url: '', // page request url
            otherParames: false, // other parameters, values: false, A Object or A jquery serialize Array
            autoLoad: true, // load onReady
            pageAll: false, // display all datas, no paging only count
            pageSize: 20, // page size. if set value little then 1, then pageAll will auto set true
            pageSizeSelect: false, // if display pageSize select option
            pageSizeForGrid: [5, 10, 20, 25, 50, 100, 200, 500], // pageSize select option
            pageIncorrectTurnAlert: true, // if turn incorrect page alert(firstPage, prevPage, nextPage, lastPage)
            multiSort: false, // multi column sort support
            displayBlankRows: true,
            lineWrap: false, // if grid cell content wrap, if false then td use style: white-space: nowrap; overflow: hidden; text-overflow: ellipsis; if true then td use style: word-break: break-all;
            stripeRows: false, // stripe rows
            changeColorIfRowSelected: true, // change color if row selected
            pagingLittleToolbar: false, // if display paging little toolbar
            pagingToolbarAlign: 'right',
            pagingBtnClass: 'pagingBtn', // paging toolbar button css class
            displayPagingToolbarOnlyMultiPages: false,
            isProcessLockScreen: true,
            // longLengthAotoSubAndTip: if column's value length longer than it, auto sub and tip it.
            //    sub: content.substring(0, MaxLength-3) + '...'. if column's render is not false, then this property is not make effective to it.
            longLengthAotoSubAndTip: true,
            colsProperties: {
                // body row every column config
                align: 'left',
                maxLength: 40, // every column's value display max length
                // config properties's name
                indexAttr: 'w_index',
                sortAttr: 'w_sort', // use: w_sort="id" or w_sort="id,desc" or w_sort="id,asc"
                alignAttr: 'w_align',
                lengthAttr: 'w_length', // per column's value display max length, default maxLength
                renderAttr: 'w_render', // use: w_render="funMethod"
                hiddenAttr: 'w_hidden',
                tipAttr: 'w_tip'
            },
            // request params name
            requestParamsName: {
                pageSize: 'pageSize',
                curPage: 'curPage',
                sortName: 'sortName',
                sortOrder: 'sortOrder'
            },
            // before page ajax request send
            beforeSend: function (options, XMLHttpRequest) {
            },
            // after page ajax request complete
            complete: function (options, XMLHttpRequest, textStatus) {
            },
            // process userdata, process before grid render data
            processUserdata: function (userdata, options) {
            },
            // extend
            extend: {
                // extend init grid methods
                initGridMethods: {
                    // methodAlias: methodName // method params: gridId, options
                },
                // extend before render grid methods
                beforeRenderGridMethods: {
                    // methodAlias: methodName // method params: parseSuccess, gridData, options
                },
                // extend render per row methods, no matter blank row or not blank row, before render per column methods
                renderPerRowMethods: {
                    // methodAlias: methodName // method params: record, rowIndex, trObj, options
                },
                // extend render per column methods, no matter blank column or not blank column
                renderPerColumnMethods: {
                    // methodAlias: methodName // method params: record, rowIndex, colIndex, tdObj, trObj, options
                },
                // extend after render grid methods
                afterRenderGridMethods: {
                    // methodAlias: methodName // method params: parseSuccess, gridData, options
                }
            },
            /**
             * additional before render grid.
             *
             * @param parseSuccess if ajax data parse success, true or false
             * @param gridData page ajax return data
             * @param options
             */
            additionalBeforeRenderGrid: function (parseSuccess, gridData, options) {
            },
            /**
             * additional render per row, no matter blank row or not blank row, before additional render per column.
             *
             * @param record row record, may be null
             * @param rowIndex row index, from 0
             * @param trObj row tr obj
             * @param options
             */
            additionalRenderPerRow: function (record, rowIndex, trObj, options) {
            },
            /**
             * additional render per column, no matter blank column or not blank column.
             *
             * @param record row record, may be null
             * @param rowIndex row index, from 0
             * @param colIndex column index, from 0
             * @param tdObj column td obj
             * @param trObj row tr obj
             * @param options
             */
            additionalRenderPerColumn: function (record, rowIndex, colIndex, tdObj, trObj, options) {
            },
            /**
             * additional after render grid.
             *
             * @param parseSuccess if ajax data parse success, true or false
             * @param gridData page ajax return data
             * @param options
             */
            additionalAfterRenderGrid: function (parseSuccess, gridData, options) {
            }
        },

        gridObjs: {},

        init: function (gridId, settings) {
            if (!$('#' + gridId).hasClass('bsgrid')) {
                $('#' + gridId).addClass('bsgrid');
            }

            var options = {
                settings: $.extend(true, {}, $.fn.bsgrid.defaults, settings),
                gridId: gridId,
                noPagingationId: gridId + '_no_pagination',
                pagingOutTabId: gridId + '_pt_outTab',
                pagingId: gridId + '_pt',
                // sort
                sortName: '',
                sortOrder: '',
                otherParames: settings.otherParames,
                totalRows: 0,
                totalPages: 0,
                curPage: 1,
                curPageRowsNum: 0,
                startRow: 0,
                endRow: 0
            };

            if ($('#' + gridId).find('thead').length == 0) {
                $('#' + gridId).prepend('<thead></thead>');
                $('#' + gridId).find('tr:lt(' + ($('#' + gridId + ' tr').length - $('#' + gridId + ' tfoot tr').length) + ')').appendTo($('#' + gridId + ' thead'));
            }
            if ($('#' + gridId).find('tbody').length == 0) {
                $('#' + gridId + ' thead').after('<tbody></tbody>');
            }
            if ($('#' + gridId).find('tfoot').length == 0) {
                $('#' + gridId).append('<tfoot style="display: none;"></tfoot>');
            }

            options.columnsModel = $.fn.bsgrid.initColumnsModel(options);

            if (settings.pageSizeForGrid != undefined) {
                options.settings.pageSizeForGrid = settings.pageSizeForGrid;
            }

            options.settings.dataType = options.settings.dataType.toLowerCase();
            if (options.settings.pageSizeSelect) {
                if ($.inArray(options.settings.pageSize, options.settings.pageSizeForGrid) == -1) {
                    options.settings.pageSizeForGrid.push(options.settings.pageSize);
                }
                options.settings.pageSizeForGrid.sort(function (a, b) {
                    return a - b;
                });
            }

            var gridObj = {
                options: options,
                getPageCondition: function (curPage) {
                    return $.fn.bsgrid.getPageCondition(curPage, options);
                },
                page: function (curPage) {
                    $.fn.bsgrid.page(curPage, options);
                },
                loadGridData: function (dataType, gridData) {
                    $.fn.bsgrid.loadGridData(dataType, gridData, options);
                },
                getSelectedRow: function () {
                    return $.fn.bsgrid.getSelectedRow(options);
                },
                selectRow: function (row) {
                    return $.fn.bsgrid.selectRow(row, options);
                },
                unSelectRow: function () {
                    return $.fn.bsgrid.unSelectRow(options);
                },
                getUserdata: function () {
                    return $.fn.bsgrid.getUserdata(options);
                },
                getRowRecord: function (rowObj) {
                    return $.fn.bsgrid.getRowRecord(rowObj);
                },
                getRecord: function (row) {
                    return $.fn.bsgrid.getRecord(row, options);
                },
                getRecordIndexValue: function (record, index) {
                    return $.fn.bsgrid.getRecordIndexValue(record, index, options);
                },
                getColumnValue: function (row, index) {
                    return $.fn.bsgrid.getColumnValue(row, index, options);
                },
                sort: function (obj) {
                    $.fn.bsgrid.sort(obj, options);
                },
                getGridHeaderObject: function () {
                    return $.fn.bsgrid.getGridHeaderObject(options);
                },
                getColumnAttr: function (colIndex, attrName) {
                    return $.fn.bsgrid.getColumnAttr(colIndex, attrName, options);
                },
                appendHeaderSort: function () {
                    $.fn.bsgrid.appendHeaderSort(options);
                },
                setGridBlankBody: function () {
                    $.fn.bsgrid.setGridBlankBody(options);
                },
                createPagingOutTab: function () {
                    $.fn.bsgrid.createPagingOutTab(options);
                },
                clearGridBodyData: function () {
                    $.fn.bsgrid.clearGridBodyData(options);
                },
                getCurPage: function () {
                    return $.fn.bsgrid.getCurPage(options);
                },
                refreshPage: function () {
                    $.fn.bsgrid.refreshPage(options);
                },
                firstPage: function () {
                    $.fn.bsgrid.firstPage(options);
                },
                prevPage: function () {
                    $.fn.bsgrid.prevPage(options);
                },
                nextPage: function () {
                    $.fn.bsgrid.nextPage(options);
                },
                lastPage: function () {
                    $.fn.bsgrid.lastPage(options);
                },
                gotoPage: function (goPage) {
                    $.fn.bsgrid.gotoPage(options, goPage);
                },
                initPaging: function () {
                    return $.fn.bsgrid.initPaging(options);
                },
                setPagingValues: function () {
                    $.fn.bsgrid.setPagingValues(options);
                }
            };

            // store mapping grid id to gridObj
            $.fn.bsgrid.gridObjs[gridId] = gridObj;

            // if no pagination
            if (options.settings.pageAll || options.settings.pageSize < 1) {
                options.settings.pageAll = true;
                options.settings.pageSize = 0;
            }

            gridObj.appendHeaderSort();

            // init paging
            gridObj.createPagingOutTab();

            if (!options.settings.pageAll) {
                gridObj.pagingObj = gridObj.initPaging();
            }

            if (options.settings.isProcessLockScreen) {
                $.fn.bsgrid.addLockScreen(options);
            }

            try {
                // init grid extend options
                $.fn.bsgrid.extendInitGrid.initGridExtendOptions(gridId, options);
            } catch (e) {
                // do nothing
            }

            for (var key in options.settings.extend.initGridMethods) {
                options.settings.extend.initGridMethods[key](gridId, options);
            }

            // auto load
            if (options.settings.autoLoad) {
                // delay 10 millisecond for return gridObj first, then page
                setTimeout(function () {
                    gridObj.page(1);
                }, 10);
            } else {
                gridObj.setGridBlankBody();
            }

            return gridObj;
        },

        initColumnsModel: function (options) {
            var columnsModel = [];
            $.fn.bsgrid.getGridHeaderObject(options).each(function () {
                var columnModel = {};
                // column sort name, order
                columnModel.sortName = '';
                columnModel.sortOrder = '';
                var sortInfo = $.trim($(this).attr(options.settings.colsProperties.sortAttr));
                if (sortInfo.length != 0) {
                    var sortInfoArray = sortInfo.split(',');
                    columnModel.sortName = $.trim(sortInfoArray[0]);
                    columnModel.sortOrder = $.trim(sortInfoArray.length > 1 ? sortInfoArray[1] : '');
                }
                // column index
                columnModel.index = $.trim($(this).attr(options.settings.colsProperties.indexAttr));
                // column render
                columnModel.render = $.trim($(this).attr(options.settings.colsProperties.renderAttr));
                // column tip
                columnModel.tip = $.trim($(this).attr(options.settings.colsProperties.tipAttr));
                // column text max length
                var maxLen = $.trim($(this).attr(options.settings.colsProperties.lengthAttr));
                columnModel.maxLen = maxLen.length != 0 ? parseInt(maxLen) : options.settings.colsProperties.maxLength;
                // column align
                var align = $.trim($(this).attr(options.settings.colsProperties.alignAttr));
                columnModel.align = align == '' ? options.settings.colsProperties.align : align;
                // column hidden
                columnModel.hidden = $.trim($(this).attr(options.settings.colsProperties.hiddenAttr));
                columnsModel.push(columnModel);
            });
            return columnsModel;
        },

        getGridObj: function (gridId) {
            var obj = $.fn.bsgrid.gridObjs[gridId];
            return obj ? obj : null;
        },

        buildData: {
            gridData: function (type, curPage, data) {
                if (type == 'json') {
                    return $.fn.bsgrid.buildJsonData.gridData(curPage, data);
                } else if (type == 'xml') {
                    return $.fn.bsgrid.buildXmlData.gridData(curPage, data);
                }
                return false;
            }
        },

        parseData: {
            success: function (type, gridData) {
                if (type == 'json') {
                    return $.fn.bsgrid.parseJsonData.success(gridData);
                } else if (type == 'xml') {
                    return $.fn.bsgrid.parseXmlData.success(gridData);
                }
                return false;
            },
            totalRows: function (type, gridData) {
                if (type == 'json') {
                    return $.fn.bsgrid.parseJsonData.totalRows(gridData);
                } else if (type == 'xml') {
                    return $.fn.bsgrid.parseXmlData.totalRows(gridData);
                }
                return false;
            },
            curPage: function (type, gridData) {
                if (type == 'json') {
                    return $.fn.bsgrid.parseJsonData.curPage(gridData);
                } else if (type == 'xml') {
                    return $.fn.bsgrid.parseXmlData.curPage(gridData);
                }
                return false;
            },
            data: function (type, gridData) {
                if (type == 'json') {
                    return $.fn.bsgrid.parseJsonData.data(gridData);
                } else if (type == 'xml') {
                    return $.fn.bsgrid.parseXmlData.data(gridData);
                }
                return false;
            },
            userdata: function (type, gridData) {
                if (type == 'json') {
                    return $.fn.bsgrid.parseJsonData.userdata(gridData);
                } else if (type == 'xml') {
                    return $.fn.bsgrid.parseXmlData.userdata(gridData);
                }
                return false;
            },
            getDataLen: function (type, gridData) {
                if (type == 'json' || type == 'xml') {
                    return $.fn.bsgrid.parseData.data(type, gridData).length;
                }
                return 0;
            },
            getRecord: function (type, data, row) {
                if (type == 'json') {
                    return $.fn.bsgrid.parseJsonData.getRecord(data, row);
                } else if (type == 'xml') {
                    return $.fn.bsgrid.parseXmlData.getRecord(data, row);
                }
                return false;
            },
            getColumnValue: function (type, record, index) {
                if (type == 'json') {
                    return $.fn.bsgrid.parseJsonData.getColumnValue(record, index);
                } else if (type == 'xml') {
                    return $.fn.bsgrid.parseXmlData.getColumnValue(record, index);
                }
                return false;
            }
        },

        buildJsonData: {
            gridData: function (curPage, data) {
                return {
                    "success": true,
                    "totalRows": data.length,
                    "curPage": curPage,
                    "data": data
                };
            }
        },

        parseJsonData: {
            success: function (json) {
                return json.success;
            },
            totalRows: function (json) {
                return json.totalRows;
            },
            curPage: function (json) {
                return json.curPage;
            },
            data: function (json) {
                return json.data;
            },
            userdata: function (json) {
                return json.userdata;
            },
            getRecord: function (data, row) {
                return data[row];
            },
            getColumnValue: function (record, index) {
                return $.trim(record[index]);
            }
        },

        buildXmlData: {
            gridData: function (curPage, data) {
                return '<?xml version="1.0" encoding="UTF-8"?>'
                    + '<gridData>'
                    + '<success>true</success>'
                    + '<totalRows>' + $('<xml>' + data + '</xml>').find('row').length + '</totalRows>'
                    + '<curPage>' + curPage + '</curPage>'
                    + '<data>'
                    + data
                    + '</data>'
                    + '</gridData>';
            }
        },

        parseXmlData: {
            success: function (xml) {
                return $.trim($(xml).find('gridData success').text()) == 'true';
            },
            totalRows: function (xml) {
                return parseInt($(xml).find('gridData totalRows').text());
            },
            curPage: function (xml) {
                return parseInt($(xml).find('gridData curPage').text());
            },
            data: function (xml) {
                return $(xml).find('gridData data row');
            },
            userdata: function (xml) {
                return $(xml).find('gridData userdata');
            },
            getRecord: function (data, row) {
                return data.eq(row);
            },
            getColumnValue: function (record, index) {
                return $.trim(record.find(index).text());
            }
        },

        getPageCondition: function (curPage, options) {
            // other parames
            var params = new StringBuilder();
            if (options.otherParames == false) {
                // do nothing
            } else if ((typeof options.otherParames).toLowerCase() == 'string' || options.otherParames instanceof String) {
                params.append('&' + options.otherParames);
            } else if (options.otherParames instanceof Array) {
                $.each(options.otherParames, function (i, objVal) {
                    params.append('&' + objVal.name + '=' + objVal.value);
                });
            } else {
                for (var key in options.otherParames) {
                    params.append('&' + key + '=' + options.otherParames[key]);
                }
            }

            var condition = params.length == 0 ? '' : params.toString().substring(1);
            condition += (condition.length == 0 ? '' : '&')
            + options.settings.requestParamsName.pageSize + '=' + options.settings.pageSize
            + '&' + options.settings.requestParamsName.curPage + '=' + curPage
            + '&' + options.settings.requestParamsName.sortName + '=' + options.sortName
            + '&' + options.settings.requestParamsName.sortOrder + '=' + options.sortOrder;
            return condition;
        },

        page: function (curPage, options) {
            if ($.trim(curPage) == '' || isNaN(curPage)) {
                $.fn.bsgrid.alert($.bsgridLanguage.needInteger);
                return;
            }
            var dataType = options.settings.dataType;
            if (options.settings.localData != false) {
                if (dataType == 'json') {
                    $.fn.bsgrid.loadGridData(dataType, $.fn.bsgrid.buildData.gridData(dataType, curPage, options.settings.localData), options);
                } else if (dataType == 'xml') {
                    $.fn.bsgrid.loadGridData(dataType, '<xml>' + $.fn.bsgrid.buildData.gridData(dataType, curPage, options.settings.localData) + '</xml>', options);
                }
                return;
            }
            $.ajax({
                type: 'post',
                url: options.settings.url,
                data: $.fn.bsgrid.getPageCondition(curPage, options),
                dataType: dataType,
                beforeSend: function (XMLHttpRequest) {
                    if (options.settings.isProcessLockScreen) {
                        $.fn.bsgrid.lockScreen(options);
                    }
                    options.settings.beforeSend(options, XMLHttpRequest);
                },
                complete: function (XMLHttpRequest, textStatus) {
                    options.settings.complete(options, XMLHttpRequest, textStatus);
                    if (options.settings.isProcessLockScreen) {
                        $.fn.bsgrid.unlockScreen(options);
                    }
                },
                success: function (gridData, textStatus) {
                    $.fn.bsgrid.loadGridData(dataType, gridData, options);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $.fn.bsgrid.alert($.bsgridLanguage.errorForSendOrRequestData);
                }
            });
        },

        loadGridData: function (dataType, gridData, options) {
            var parseSuccess = $.fn.bsgrid.parseData.success(dataType, gridData);
            for (var key in options.settings.extend.beforeRenderGridMethods) {
                options.settings.extend.beforeRenderGridMethods[key](parseSuccess, gridData, options);
            }
            options.settings.additionalBeforeRenderGrid(parseSuccess, gridData, options);
            if (parseSuccess) {
                // userdata
                var userdata = $.fn.bsgrid.parseData.userdata(dataType, gridData);
                $.fn.bsgrid.storeUserdata(userdata, options);
                options.settings.processUserdata(userdata, options);

                var totalRows = parseInt($.fn.bsgrid.parseData.totalRows(dataType, gridData));
                var curPage = parseInt($.fn.bsgrid.parseData.curPage(dataType, gridData));
                curPage = Math.max(curPage, 1);

                if (options.settings.pageAll) {
                    // display all datas, no paging
                    curPage = 1;
                    options.settings.pageSize = totalRows;
                    $('#' + options.noPagingationId).html(totalRows);
                }

                var pageSize = options.settings.pageSize;
                var totalPages = parseInt(totalRows / pageSize);
                totalPages = parseInt((totalRows % pageSize == 0) ? totalPages : totalPages + 1);
                var curPageRowsNum = $.fn.bsgrid.parseData.getDataLen(dataType, gridData);
                curPageRowsNum = curPageRowsNum > pageSize ? pageSize : curPageRowsNum;
                curPageRowsNum = (curPage * pageSize < totalRows) ? curPageRowsNum : (totalRows - (curPage - 1) * pageSize);
                var startRow = (curPage - 1) * pageSize + 1;
                var endRow = startRow + curPageRowsNum - 1;
                startRow = curPageRowsNum <= 0 ? 0 : startRow;
                endRow = curPageRowsNum <= 0 ? 0 : endRow;

                // set options pagination values
                options.totalRows = totalRows;
                options.totalPages = totalPages;
                options.curPage = curPage;
                options.curPageRowsNum = curPageRowsNum;
                options.startRow = startRow;
                options.endRow = endRow;

                if (!options.settings.pageAll) {
                    $.fn.bsgrid.setPagingValues(options);
                }

                if (options.settings.displayPagingToolbarOnlyMultiPages && totalPages <= 1) {
                    $('#' + options.pagingId).hide();
                    $('#' + options.pagingOutTabId).hide();
                } else {
                    $('#' + options.pagingOutTabId).show();
                    $('#' + options.pagingId).show();
                }

                $.fn.bsgrid.setGridBlankBody(options);
                if (curPageRowsNum == 0) {
                    return;
                }

                var data = $.fn.bsgrid.parseData.data(dataType, gridData);
                var dataLen = data.length;
                // add rows click event
                $.fn.bsgrid.addRowsClickEvent(options);
                $('#' + options.gridId + ' tbody tr').each(
                    function (i) {
                        var trObj = $(this);
                        var record = null;
                        if (i < curPageRowsNum && i < dataLen) {
                            // support parse return all datas or only return current page datas
                            record = $.fn.bsgrid.parseData.getRecord(dataType, data, dataLen != totalRows ? i : startRow + i - 1);
                        }
                        $.fn.bsgrid.storeRowData(i, record, options);

                        for (var key in options.settings.extend.renderPerRowMethods) {
                            options.settings.extend.renderPerRowMethods[key](record, i, trObj, options);
                        }
                        options.settings.additionalRenderPerRow(record, i, trObj, options);

                        var columnsModel = options.columnsModel;
                        $(this).find('td').each(function (j) {
                            if (i < curPageRowsNum && i < dataLen) {
                                // column index
                                var index = columnsModel[j].index;
                                // column render
                                var render = columnsModel[j].render;
                                if (render != '') {
                                    var render_method = eval(render);
                                    var render_html = render_method(record, i, j, options);
                                    $(this).html(render_html);
                                } else if (index != '') {
                                    var value = $.fn.bsgrid.parseData.getColumnValue(dataType, record, index);
                                    // column tip
                                    if (columnsModel[j].tip == 'true') {
                                        $.fn.bsgrid.columnTip(this, value, record);
                                    }
                                    if (options.settings.longLengthAotoSubAndTip) {
                                        $.fn.bsgrid.longLengthSubAndTip(this, value, columnsModel[j].maxLen, record);
                                    } else {
                                        $(this).html(value);
                                    }
                                }
                            } else {
                                $(this).html('&nbsp;');
                            }
                            for (var key in options.settings.extend.renderPerColumnMethods) {
                                var renderPerColumn_html = options.settings.extend.renderPerColumnMethods[key](record, i, j, $(this), trObj, options);
                                if (renderPerColumn_html != null && renderPerColumn_html != false) {
                                    $(this).html(renderPerColumn_html);
                                }
                            }
                            options.settings.additionalRenderPerColumn(record, i, j, $(this), trObj, options);
                        });
                    }
                );
            } else {
                $.fn.bsgrid.alert($.bsgridLanguage.errorForRequestData);
            }
            for (var key in options.settings.extend.afterRenderGridMethods) {
                options.settings.extend.afterRenderGridMethods[key](parseSuccess, gridData, options);
            }
            options.settings.additionalAfterRenderGrid(parseSuccess, gridData, options);
        },

        changGridAction:function(options){
            var row = $.fn.bsgrid.getSelectedRow(options);
            var rec = $.fn.bsgrid.getRowRecord(row);
            if (!rec) {
                $('#' + options.gridId + '-header').find('[grid-edit]').addClass('disabled');
                $('#' + options.gridId + '-header').find('[grid-delete]').addClass('disabled');
                return false;
            };

            var objHeader = $('#' + options.gridId + '-header');
            if (objHeader.length == 1) {
                var editBtn = objHeader.find('[grid-edit]');
                var deleteBtn = objHeader.find('[grid-delete]');
                
                // gridObj.getRowRecord(gridObj.getSelectedRow())
                var id = rec['id'];
                if (editBtn.length == 1) {
                    var url = editBtn.attr('href');
                    url = U('id',id,url);
                    editBtn.attr('href',url);
                    editBtn.removeClass('disabled');
                }
                if (deleteBtn.length == 1) {
                    var url = deleteBtn.attr('href');
                    url = U('id',id,url);
                    deleteBtn.attr('href',url);
                    deleteBtn.removeClass('disabled');
                }
            };
        },

        addRowsClickEvent: function (options) {
            $('#' + options.gridId + ' tbody tr:lt(' + options.curPageRowsNum + ')').click(function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected').removeClass('active');
                } else {
                    $.fn.bsgrid.unSelectRow(options);
                    $(this).addClass('selected');
                    if (options.settings.changeColorIfRowSelected) {
                        $(this).addClass('active');
                    }
                }
                $.fn.bsgrid.changGridAction(options);
            });

        },

        getSelectedRow: function (options) {
            return $('#' + options.gridId + ' tbody tr.selected');
        },

        selectRow: function (row, options) {
            $.fn.bsgrid.unSelectRow(options);
            var trObj = $('#' + options.gridId + ' tbody tr:eq(' + row + ')');
            trObj.addClass('selected');
            if (options.settings.changeColorIfRowSelected) {
                trObj.addClass('active');
            }
        },

        unSelectRow: function (options) {
            $.fn.bsgrid.getSelectedRow(options).removeClass('selected').removeClass('active');
        },

        getUserdata: function (options) {
            $('#' + options.gridId).data('userdata');
        },

        storeUserdata: function (userdata, options) {
            $('#' + options.gridId).data('userdata', userdata);
        },

        getRowRecord: function (rowObj) {
            return rowObj.data('record');
        },

        storeRowData: function (row, record, options) {
            $('#' + options.gridId + ' tbody tr:eq(' + row + ')').data('record', record);
        },

        getRecord: function (row, options) {
            var record = $('#' + options.gridId + ' tbody tr:eq(' + row + ')').data('record');
            return record == undefined ? null : record;
        },

        getRecordIndexValue: function (record, index, options) {
            if (record == null) {
                return '';
            } else {
                return $.fn.bsgrid.parseData.getColumnValue(options.settings.dataType, record, index);
            }
        },

        getColumnValue: function (row, index, options) {
            var record = $.fn.bsgrid.getRecord(row, options);
            return $.fn.bsgrid.getRecordIndexValue(record, index, options);
        },

        sort: function (obj, options) {
            options.sortName = '';
            options.sortOrder = '';
            var aObj = $(obj).find('a');
            var field = $(aObj).attr('sortName');
            var columnsModel = options.columnsModel;
            $.fn.bsgrid.getGridHeaderObject(options).each(function (i) {
                var sortName = columnsModel[i].sortName;
                if (sortName != '') {
                    var sortOrder = $.fn.bsgrid.getSortOrder($(this), options);

                    if (!options.settings.multiSort && sortName != field) {
                        // revert style
                        $(this).find('a').attr('class', 'sort sort-view');
                    } else {
                        if (sortName == field) {
                            if (sortOrder == '') {
                                sortOrder = 'desc';
                            } else if (sortOrder == 'desc') {
                                sortOrder = 'asc';
                            } else if (sortOrder == 'asc') {
                                sortOrder = '';
                            }
                            $(this).find('a').attr('class', 'sort sort-' + (sortOrder == '' ? 'view' : sortOrder));
                        }
                        if (sortOrder != '') {
                            options.sortName = ($.trim(options.sortName) == '') ? sortName : (options.sortName + ',' + sortName);
                            options.sortOrder = ($.trim(options.sortOrder) == '') ? sortOrder : (options.sortOrder + ',' + sortOrder);
                        }
                    }
                }
            });

            $.fn.bsgrid.refreshPage(options);
        },

        getSortOrder: function (obj, options) {
            var sortOrder = $.trim($(obj).find('a').attr('class'));
            if (sortOrder == 'sort sort-view') {
                sortOrder = '';
            } else if (sortOrder == 'sort sort-asc') {
                sortOrder = 'asc';
            } else if (sortOrder == 'sort sort-desc') {
                sortOrder = 'desc';
            } else {
                sortOrder = '';
            }
            return sortOrder;
        },

        /**
         * Note only return thead last tr's th.
         *
         * @param options
         * @returns {*}
         */
        getGridHeaderObject: function (options) {
            return $('#' + options.gridId + ' thead tr:last').find('th');
        },

        getColumnAttr: function (colIndex, attrName, options) {
            return $.trim($.fn.bsgrid.getGridHeaderObject(options).eq(colIndex).attr(attrName));
        },

        appendHeaderSort: function (options) {
            var columnsModel = options.columnsModel;
            // grid header
            $.fn.bsgrid.getGridHeaderObject(options).each(function (i) {
                // sort
                if (columnsModel[i].sortName != '') {
                    var sortName = columnsModel[i].sortName;
                    // default sort and direction
                    var sortOrder = columnsModel[i].sortOrder;
                    var sortHtml = '<a href="#" sortName="' + sortName + '" class="sort ';
                    if (sortOrder != '' && (sortOrder == 'desc' || sortOrder == 'asc')) {
                        options.sortName = ($.trim(options.sortName) == '') ? sortName : (options.sortName + ',' + sortName);
                        options.sortOrder = ($.trim(options.sortOrder) == '') ? sortOrder : (options.sortOrder + ',' + sortOrder);
                        sortHtml += 'sort-' + sortOrder;
                    } else {
                        sortHtml += 'sort-view';
                    }
                    sortHtml += '">&nbsp;&nbsp;&nbsp;</a>'; // use: "&nbsp;&nbsp;&nbsp;", different from: "&emsp;" is: IE8 and IE9 not display "&emsp;"
                    $(this).append(sortHtml).find('.sort').click(function () {
                        $.fn.bsgrid.sort($(this).parent('th'), options);
                    });
                }
            });
        },

        setGridBlankBody: function (options) {
            // remove rows
            $('#' + options.gridId + ' tbody tr').remove();

            var header = $.fn.bsgrid.getGridHeaderObject(options);
            // add rows
            var rowSb = '';
            if (options.settings.pageSize > 0) {
                var columnsModel = options.columnsModel;

                var trSb = new StringBuilder();
                trSb.append('<tr>');
                for (var hi = 0; hi < header.length; hi++) {
                    trSb.append('<td style="text-align: ' + columnsModel[hi].align + ';');
                    if (columnsModel[hi].hidden == 'true') {
                        header.eq(hi).css('display', 'none');
                        trSb.append(' display: none;');
                    }
                    trSb.append('"');
                    trSb.append('></td>');
                }
                trSb.append('</tr>');
                rowSb = trSb.toString();
            }
            var rowsSb = new StringBuilder();
            var curPageRowsNum = options.settings.pageSize;
            if (!options.settings.displayBlankRows) {
                curPageRowsNum = options.endRow - options.startRow + 1;
                curPageRowsNum = options.endRow > 0 ? curPageRowsNum : 0;
            }
            if (curPageRowsNum == 0) {
                rowsSb.append('<tr><td colspan="' + header.length + '">' + $.bsgridLanguage.noDataToDisplay + '</td></tr>');
            } else {
                for (var pi = 0; pi < curPageRowsNum; pi++) {
                    rowsSb.append(rowSb);
                }
            }
            $('#' + options.gridId + ' tbody').append(rowsSb.toString());

            if (curPageRowsNum != 0) {
                if (options.settings.stripeRows) {
                    $('#' + options.gridId + ' tbody tr:even').addClass('even_index_row');
                }
            }

            if (!options.settings.lineWrap) {
                $('#' + options.gridId + ' tbody tr td').addClass('lineNoWrap');
            } else {
                $('#' + options.gridId + ' tbody tr td').addClass('lineWrap');
            }
        },

        createPagingOutTab: function (options) {
            var pagingOutTabSb = new StringBuilder();
            pagingOutTabSb.append('<table id="' + options.pagingOutTabId + '" class="bsgridPagingOutTab" style="display: none;"><tr><td align="' + options.settings.pagingToolbarAlign + '">');
            // display all datas, no paging
            if (options.settings.pageAll) {
                pagingOutTabSb.append($.bsgridLanguage.noPagingation(options.noPagingationId) + '&nbsp;&nbsp;&nbsp;');
            }
            pagingOutTabSb.append('</td></tr></table>');
            var footer = $('#' + options.gridId+'-footer');
            if (footer.length == 1) {
                footer.append(pagingOutTabSb.toString());
            }else{
                $('#' + options.gridId).after(pagingOutTabSb.toString());
            }
        },

        clearGridBodyData: function (options) {
            $('#' + options.gridId + ' tbody tr td').html('&nbsp;');
        },

        /**
         * add lock screen.
         *
         * @param options
         */
        addLockScreen: function (options) {
            if ($('.bsgrid.lockscreen').length == 0) {
                var lockScreenHtml = new StringBuilder();
                lockScreenHtml.append('<div class="bsgrid lockscreen" times="0">');
                lockScreenHtml.append('</div>');
                lockScreenHtml.append('<div class="bsgrid loading_div">');
                lockScreenHtml.append('<table><tr><td><center><div class="bsgrid loading"><span>&nbsp;&emsp;</span>&nbsp;' + $.bsgridLanguage.loadingDataMessage + '&emsp;<center></div></td></tr></table>');
                lockScreenHtml.append('</div>');
                $('body').append(lockScreenHtml.toString());
            }
        },

        /**
         * open lock screen.
         *
         * @param options
         */
        lockScreen: function (options) {
            $('.bsgrid.lockscreen').attr('times', parseInt($('.bsgrid.lockscreen').attr('times')) + 1);
            if ($('.bsgrid.lockscreen').css('display') == 'none') {
                $('.bsgrid.lockscreen').show();
                $('.bsgrid.loading_div').show();
            }
        },

        /**
         * close lock screen.
         *
         * @param options
         */
        unlockScreen: function (options) {
            $('.bsgrid.lockscreen').attr('times', parseInt($('.bsgrid.lockscreen').attr('times')) - 1);
            if ($('.bsgrid.lockscreen').attr('times') == '0') {
                // delay 0.05s, to make lock screen look better
                setTimeout(function () {
                    $('.bsgrid.lockscreen').hide();
                    $('.bsgrid.loading_div').hide();
                }, 50);
            }
        },

        /**
         * tip column.
         *
         * @param obj column td obj
         * @param value column's value
         * @param record row record
         */
        columnTip: function (obj, value, record) {
            $(obj).attr('title', value);
        },

        /**
         * alert message.
         *
         * @param msg message
         */
        alert: function (msg) {
            try {
                $.bsgrid.alert(msg);
            } catch (e) {
                alert(msg);
            }
        },

        /**
         * if column's value length longer than it, auto sub and tip it.
         *    sub: txt.substring(0, MaxLength-3) + '...'.
         *
         * @param obj column td obj
         * @param value column's value
         * @param maxLen max length
         * @param record row record
         */
        longLengthSubAndTip: function (obj, value, maxLen, record) {
            var tip = false;
            if (value.length > maxLen) {
                try {
                    if (value.indexOf('<') < 0 || value.indexOf('>') < 2 || $(value).text().length == 0) {
                        tip = true;
                    }
                } catch (e) {
                    tip = true;
                }
            }
            if (tip) {
                $(obj).html(value.substring(0, maxLen - 3) + '...');
                $.fn.bsgrid.columnTip(obj, value, record);
            } else {
                $(obj).html(value);
            }
        },

        getCurPage: function (options) {
            return $.fn.bsgrid.getGridObj(options.gridId).pagingObj.getCurPage();
        },

        refreshPage: function (options) {
            if (!options.settings.pageAll) {
                $.fn.bsgrid.getGridObj(options.gridId).pagingObj.refreshPage();
            } else {
                $.fn.bsgrid.page(1, options);
            }
        },

        firstPage: function (options) {
            $.fn.bsgrid.getGridObj(options.gridId).pagingObj.firstPage();
        },

        prevPage: function (options) {
            $.fn.bsgrid.getGridObj(options.gridId).pagingObj.prevPage();
        },

        nextPage: function (options) {
            $.fn.bsgrid.getGridObj(options.gridId).pagingObj.nextPage();
        },

        lastPage: function (options) {
            $.fn.bsgrid.getGridObj(options.gridId).pagingObj.lastPage();
        },

        gotoPage: function (options, goPage) {
            $.fn.bsgrid.getGridObj(options.gridId).pagingObj.gotoPage(goPage);
        },

        /**
         * init paging.
         *
         * @param options grid options
         */
        initPaging: function (options) {
            $('#' + options.pagingOutTabId + ' td').attr('id', options.pagingId);
            // config same properties's
            return $.fn.bsgrid_paging.init(options.pagingId, {
                gridId: options.gridId,
                pageSize: options.settings.pageSize,
                pageSizeSelect: options.settings.pageSizeSelect,
                pageSizeForGrid: options.settings.pageSizeForGrid,
                pageIncorrectTurnAlert: options.settings.pageIncorrectTurnAlert,
                pagingLittleToolbar: options.settings.pagingLittleToolbar,
                pagingBtnClass: options.settings.pagingBtnClass
            });
        },

        /**
         * Set paging values.
         *
         * @param options grid options
         */
        setPagingValues: function (options) {
            $.fn.bsgrid.getGridObj(options.gridId).pagingObj.setPagingValues(options.curPage, options.totalRows);
        }

    };

})(jQuery);


/**
 * jQuery.bsgrid v1.35 by @Baishui2004
 * Copyright 2014 Apache v2 License
 * https://github.com/baishui2004/jquery.bsgrid
 */
/**
 * require common.js.
 *
 * @author Baishui2004
 * @Date August 31, 2014
 */
(function ($) {

    $.fn.bsgrid_paging = {

        // defaults settings
        defaults: {
            loopback: false, // if true, page 1 prev then totalPages, totalPages next then 1
            pageSize: 20, // page size
            pageSizeSelect: false, // if display pageSize select option
            pageSizeForGrid: [5, 10, 20, 25, 50, 100, 200, 500], // pageSize select option
            pageIncorrectTurnAlert: true, // if turn incorrect page alert(firstPage, prevPage, nextPage, lastPage)
            pagingLittleToolbar: false, // if display paging little toolbar
            pagingBtnClass: 'pagingBtn' // paging toolbar button css class
        },

        pagingObjs: {},

        /**
         * init paging.
         */
        init: function (pagingId, settings) {
            var options = {
                settings: $.extend(true, {}, $.fn.bsgrid_paging.defaults, settings),

                pagingId: pagingId,
                totalRowsId: pagingId + '_totalRows',
                totalPagesId: pagingId + '_totalPages',
                curPageId: pagingId + '_curPage',
                gotoPageInputId: pagingId + '_gotoPageInput',
                gotoPageId: pagingId + '_gotoPage',
                refreshPageId: pagingId + '_refreshPage',
                pageSizeId: pagingId + '_pageSize',
                firstPageId: pagingId + '_firstPage',
                prevPageId: pagingId + '_prevPage',
                nextPageId: pagingId + '_nextPage',
                lastPageId: pagingId + '_lastPage',
                startRowId: pagingId + '_startRow',
                endRowId: pagingId + '_endRow',

                totalRows: 0,
                totalPages: 0,
                curPage: 1,
                curPageRowsNum: 0,
                startRow: 0,
                endRow: 0
            };
            if (settings.pageSizeForGrid != undefined) {
                options.settings.pageSizeForGrid = settings.pageSizeForGrid;
            }

            var pagingObj = {
                options: options,
                page: function (curPage) {
                    $.fn.bsgrid_paging.page(curPage, options);
                },
                getCurPage: function () {
                    return $.fn.bsgrid_paging.getCurPage(options);
                },
                refreshPage: function () {
                    $.fn.bsgrid_paging.refreshPage(options);
                },
                firstPage: function () {
                    $.fn.bsgrid_paging.firstPage(options);
                },
                prevPage: function () {
                    $.fn.bsgrid_paging.prevPage(options);
                },
                nextPage: function () {
                    $.fn.bsgrid_paging.nextPage(options);
                },
                lastPage: function () {
                    $.fn.bsgrid_paging.lastPage(options);
                },
                gotoPage: function (goPage) {
                    $.fn.bsgrid_paging.gotoPage(options, goPage);
                },
                createPagingToolbar: function () {
                    return $.fn.bsgrid_paging.createPagingToolbar(options);
                },
                setPagingToolbarEvents: function () {
                    $.fn.bsgrid_paging.setPagingToolbarEvents(options);
                },
                dynamicChangePagingButtonStyle: function () {
                    $.fn.bsgrid_paging.dynamicChangePagingButtonStyle(options);
                },
                setPagingValues: function (curPage, totalRows) {
                    $.fn.bsgrid_paging.setPagingValues(curPage, totalRows, options);
                }
            };

            // store mapping paging id to pagingObj
            $.fn.bsgrid_paging.pagingObjs[pagingId] = pagingObj;

            $('#' + pagingId).append(pagingObj.createPagingToolbar());
            // page size select
            if (options.settings.pageSizeSelect) {
                if ($.inArray(options.settings.pageSize, options.settings.pageSizeForGrid) == -1) {
                    options.settings.pageSizeForGrid.push(options.settings.pageSize);
                }
                options.settings.pageSizeForGrid.sort(function (a, b) {
                    return a - b;
                });
                var optionsSb = new StringBuilder();
                for (var i = 0; i < options.settings.pageSizeForGrid.length; i++) {
                    var pageVal = options.settings.pageSizeForGrid[i];
                    optionsSb.append('<option value="' + pageVal + '">' + pageVal + '</option>');
                }
                $('#' + options.pageSizeId).html(optionsSb.toString()).val(options.settings.pageSize);
            }
            pagingObj.setPagingToolbarEvents();

            return pagingObj;
        },

        getPagingObj: function (pagingId) {
            var obj = $.fn.bsgrid_paging.pagingObjs[pagingId];
            return obj ? obj : null;
        },

        page: function (curPage, options) {
            var gridObj = $.fn.bsgrid.getGridObj(options.settings.gridId);
            gridObj.options.settings.pageSize = options.settings.pageSize;
            $.fn.bsgrid.page(curPage, gridObj.options);
        },

        getCurPage: function (options) {
            var curPage = $('#' + options.curPageId).html();
            return curPage == '' ? 1 : curPage;
        },

        refreshPage: function (options) {
            $.fn.bsgrid_paging.page($.fn.bsgrid_paging.getCurPage(options), options);
        },

        firstPage: function (options) {
            var curPage = $.fn.bsgrid_paging.getCurPage(options);
            if (curPage <= 1) {
                $.fn.bsgrid_paging.incorrectTurnAlert(options, $.bsgridLanguage.isFirstPage);
                return;
            }
            $.fn.bsgrid_paging.page(1, options);
        },

        prevPage: function (options) {
            var curPage = $.fn.bsgrid_paging.getCurPage(options);
            if (curPage <= 1) {
                if (options.settings.loopback && options.totalPages > 0) {
                    $.fn.bsgrid_paging.page(options.totalPages, options);
                    return;
                } else {
                    $.fn.bsgrid_paging.incorrectTurnAlert(options, $.bsgridLanguage.isFirstPage);
                    return;
                }
            }
            $.fn.bsgrid_paging.page(parseInt(curPage) - 1, options);
        },

        nextPage: function (options) {
            var curPage = $.fn.bsgrid_paging.getCurPage(options);
            if (curPage >= options.totalPages) {
                if (options.settings.loopback && curPage > 0) {
                    $.fn.bsgrid_paging.page(1, options);
                    return;
                } else {
                    $.fn.bsgrid_paging.incorrectTurnAlert(options, $.bsgridLanguage.isLastPage);
                    return;
                }
            }
            $.fn.bsgrid_paging.page(parseInt(curPage) + 1, options);
        },

        lastPage: function (options) {
            var curPage = $.fn.bsgrid_paging.getCurPage(options);
            if (curPage >= options.totalPages) {
                $.fn.bsgrid_paging.incorrectTurnAlert(options, $.bsgridLanguage.isLastPage);
                return;
            }
            $.fn.bsgrid_paging.page(options.totalPages, options);
        },

        gotoPage: function (options, goPage) {
            if (goPage == undefined) {
                goPage = $('#' + options.gotoPageInputId).val();
            }
            if ($.trim(goPage) == '' || isNaN(goPage)) {
                $.fn.bsgrid_paging.alert($.bsgridLanguage.needInteger);
            } else if (parseInt(goPage) < 1 || parseInt(goPage) > options.totalPages) {
                $.fn.bsgrid_paging.alert($.bsgridLanguage.needRange(1, options.totalPages));
            } else {
                $('#' + options.gotoPageInputId).val(goPage);
                $.fn.bsgrid_paging.page(parseInt(goPage), options);
            }
        },

        incorrectTurnAlert: function (options, msg) {
            if (options.settings.pageIncorrectTurnAlert) {
                $.fn.bsgrid_paging.alert(msg);
            }
        },

        /**
         * alert message.
         *
         * @param msg message
         */
        alert: function (msg) {
            try {
                $.bsgrid.alert(msg);
            } catch (e) {
                alert(msg);
            }
        },

        /**
         * create paging toolbar.
         *
         * @param options
         */
        createPagingToolbar: function (options) {
            var pagingSb = new StringBuilder();
            var littleBar = options.settings.pagingLittleToolbar;

            pagingSb.append('<table class="bsgridPaging' + ( littleBar ? ' pagingLittleToolbar' : '') + (options.settings.pageSizeSelect ? '' : ' noPageSizeSelect') + '">');
            pagingSb.append('<tr>');
            if (options.settings.pageSizeSelect) {
                pagingSb.append('<td>' + $.bsgridLanguage.pagingToolbar.pageSizeDisplay(options.pageSizeId, littleBar) + '</td>');
            }
            pagingSb.append('<td>' + $.bsgridLanguage.pagingToolbar.currentDisplayRows(options.startRowId, options.endRowId, littleBar) + '</td>');
            pagingSb.append('<td>' + $.bsgridLanguage.pagingToolbar.totalRows(options.totalRowsId) + '</td>');
            var btnClass = options.settings.pagingBtnClass;
            pagingSb.append('<td>');
            pagingSb.append('<input class="' + btnClass + ' firstPage" type="button" id="' + options.firstPageId + '" value="' + ( littleBar ? '' : $.bsgridLanguage.pagingToolbar.firstPage) + '" />');
            pagingSb.append('&nbsp;');
            pagingSb.append('<input class="' + btnClass + ' prevPage" type="button" id="' + options.prevPageId + '" value="' + ( littleBar ? '' : $.bsgridLanguage.pagingToolbar.prevPage) + '" />');
            pagingSb.append('</td>');
            pagingSb.append('<td>' + $.bsgridLanguage.pagingToolbar.currentDisplayPageAndTotalPages(options.curPageId, options.totalPagesId) + '</td>');
            pagingSb.append('<td>');
            pagingSb.append('<input class="' + btnClass + ' nextPage" type="button" id="' + options.nextPageId + '" value="' + ( littleBar ? '' : $.bsgridLanguage.pagingToolbar.nextPage) + '" />');
            pagingSb.append('&nbsp;');
            pagingSb.append('<input class="' + btnClass + ' lastPage" type="button" id="' + options.lastPageId + '" value="' + ( littleBar ? '' : $.bsgridLanguage.pagingToolbar.lastPage) + '" />');
            pagingSb.append('</td>');
            pagingSb.append('<td class="gotoPageInputTd">');
            pagingSb.append('<input class="gotoPageInput" type="text" id="' + options.gotoPageInputId + '" />');
            pagingSb.append('</td>');
            pagingSb.append('<td class="gotoPageButtonTd">');
            pagingSb.append('<input class="' + btnClass + ' gotoPage" type="button" id="' + options.gotoPageId + '" value="' + ( littleBar ? '' : $.bsgridLanguage.pagingToolbar.gotoPage) + '" />');
            pagingSb.append('</td>');
            pagingSb.append('<td class="refreshPageTd">');
            pagingSb.append('<input class="' + btnClass + ' refreshPage" type="button" id="' + options.refreshPageId + '" value="' + ( littleBar ? '' : $.bsgridLanguage.pagingToolbar.refreshPage) + '" />');
            pagingSb.append('</td>');
            pagingSb.append('</tr>');
            pagingSb.append('</table>');

            return pagingSb.toString();
        },

        /**
         * set paging toolbar events.
         *
         * @param options
         */
        setPagingToolbarEvents: function (options) {
            if (options.settings.pageSizeSelect) {
                $('#' + options.pageSizeId).change(function () {
                    options.settings.pageSize = parseInt($(this).val());
                    $(this).trigger('blur');
                    // if change pageSize, then page first
                    $.fn.bsgrid_paging.page(1, options);
                });
            }

            $('#' + options.firstPageId).click(function () {
                $.fn.bsgrid_paging.firstPage(options);
            });
            $('#' + options.prevPageId).click(function () {
                $.fn.bsgrid_paging.prevPage(options);
            });
            $('#' + options.nextPageId).click(function () {
                $.fn.bsgrid_paging.nextPage(options);
            });
            $('#' + options.lastPageId).click(function () {
                $.fn.bsgrid_paging.lastPage(options);
            });
            $('#' + options.gotoPageInputId).keyup(function (e) {
                if (e.which == 13) {
                    $.fn.bsgrid_paging.gotoPage(options);
                }
            });
            $('#' + options.gotoPageId).click(function () {
                $.fn.bsgrid_paging.gotoPage(options);
            });
            $('#' + options.refreshPageId).click(function () {
                $.fn.bsgrid_paging.refreshPage(options);
            });
        },

        /**
         * dynamic change paging button style.
         *
         * @param options
         */
        dynamicChangePagingButtonStyle: function (options) {
            var disabledCls = 'disabledCls';
            if (options.curPage <= 1) {
                $('#' + options.firstPageId).addClass(disabledCls);
                $('#' + options.prevPageId).addClass(disabledCls);
            } else {
                $('#' + options.firstPageId).removeClass(disabledCls);
                $('#' + options.prevPageId).removeClass(disabledCls);
            }
            if (options.curPage >= options.totalPages) {
                $('#' + options.nextPageId).addClass(disabledCls);
                $('#' + options.lastPageId).addClass(disabledCls);
            } else {
                $('#' + options.nextPageId).removeClass(disabledCls);
                $('#' + options.lastPageId).removeClass(disabledCls);
            }
        },

        /**
         * Set paging values.
         *
         * @param curPage current page number
         * @param totalRows total rows number
         * @param options paging options
         */
        setPagingValues: function (curPage, totalRows, options) {
            curPage = Math.max(curPage, 1);

            var pageSize = options.settings.pageSize;
            var totalPages = parseInt(totalRows / pageSize);
            totalPages = parseInt((totalRows % pageSize == 0) ? totalPages : totalPages + 1);
            var curPageRowsNum = (curPage * pageSize < totalRows) ? pageSize : (totalRows - (curPage - 1) * pageSize);
            var startRow = (curPage - 1) * pageSize + 1;
            var endRow = startRow + curPageRowsNum - 1;
            startRow = curPageRowsNum <= 0 ? 0 : startRow;
            endRow = curPageRowsNum <= 0 ? 0 : endRow;

            options.totalRows = totalRows;
            options.totalPages = totalPages;
            options.curPage = curPage;
            options.curPageRowsNum = curPageRowsNum;
            options.startRow = startRow;
            options.endRow = endRow;

            $('#' + options.totalRowsId).html(options.totalRows);
            $('#' + options.totalPagesId).html(options.totalPages);
            $('#' + options.curPageId).html(options.curPage);
            $('#' + options.startRowId).html(options.startRow);
            $('#' + options.endRowId).html(options.endRow);

            $.fn.bsgrid_paging.dynamicChangePagingButtonStyle(options);
        }
    };

})(jQuery);


/**
 * jQuery.bsgrid v1.35 by @Baishui2004
 * Copyright 2014 Apache v2 License
 * https://github.com/baishui2004/jquery.bsgrid
 */
/**
 * @author Baishui2004
 * @Date August 31, 2014
 */
(function ($) {

    $.bsgridLanguage = {
        isFirstPage: '已经是第一页！',
        isLastPage: '已经是最后一页！',
        needInteger: '请输入数字！',
        needRange: function (start, end) {
            return '请输入一个在' + start + '到' + end + '之间的数字！';
        },
        errorForRequestData: '请求数据失败！',
        errorForSendOrRequestData: '发送或请求数据失败！',
        noPagingation: function (noPagingationId) {
            return '共:&nbsp;<span id="' + noPagingationId + '"></span>';
        },
        pagingToolbar: {
            pageSizeDisplay: function (pageSizeId, ifLittle) {
                var html = '';
                if (!ifLittle) {
                    html += '每页显示:';
                }
                return html + '&nbsp;<select id="' + pageSizeId + '"></select>';
            },
            currentDisplayRows: function (startRowId, endRowId, ifLittle) {
                var html = '';
                if (!ifLittle) {
                    html += '当前显示:';
                }
                return html + '&nbsp;<span id="' + startRowId + '"></span>&nbsp;-&nbsp;<span id="' + endRowId + '"></span>';
            },
            totalRows: function (totalRowsId) {
                return '共:&nbsp;<span id="' + totalRowsId + '"></span>';
            },
            currentDisplayPageAndTotalPages: function (curPageId, totalPagesId) {
                return '<div><span id="' + curPageId + '"></span>&nbsp;/&nbsp;<span id="' + totalPagesId + '"></span></div>';
            },
            firstPage: '首&nbsp;页',
            prevPage: '上一页',
            nextPage: '下一页',
            lastPage: '末&nbsp;页',
            gotoPage: '跳&nbsp;转',
            refreshPage: '刷&nbsp;新'
        },
        loadingDataMessage: '正在加载数据，请稍候......',
        noDataToDisplay: '没有数据可以用于显示。'
    };

})(jQuery);


