<div class="row product-group">
    <div class="col-12">
        <div class="group-list">
            <div class="group-item btn-add-group">
                <div><i class="bx bx-plus"></i></div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row group-list-price-head"></div>
        <div class="row group-list-price">
        </div>
    </div>
    <input name="properties" type="hidden">
    <input name="property_groups" type="hidden">
</div>

@push('script-extra')
    <script src="{{ theme_url('assets/libs/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{ theme_url('assets/libs/jquery-validate/jquery.additional-methods.min.js')}}"></script>
    <script>
      $(function () {
        // factory function
        function createProductGroup (id) {
          return {
            id: id,
            name: '',
            properties: [
              {
                id: 1,
                name: '',
              }
            ],

            addProperty: function (item) {
              this.properties.push(item)
            },
            addEmptyProperty: function (item) {
              this.properties.push({
                id: this.getNextId(),
                name: '',
                price: '',
                sku: ''
              })
            },
            removeProperty: function (id) {
              this.properties = this.properties.filter(property => property.id != id)
            },
            getNextId: function () {
              try {
                let maxId = this.properties.reduce((a, b) => a.id > b.id ? a : b).id
                return ++maxId
              } catch (e) {
                return 1
              }
            },
            getHtmlName: function (totalPrice, height) {
              let html = `<div class="row">`
              for (let i = 1; i <= totalPrice; i++) {
                $.each(this.properties, function (i, property) {
                  html += `<div class="col-12 group-cell" style="height: ${height * 36}px">
                            <div class="property-name">${property.name}</div>
                         </div>`
                })
              }
              html += `</div>`

              return html
            },
            draw: function () {
              let html = ''
              $.each(this.properties, function (i, property) {
                html += `
                    <tr>
                        <td>
                            <input placeholder="name"
                                group-id="${this.id}" property-id="${property.id}"
                                property-name="name" name="property-input-name" remove-input="" class="form-group property-input-name" value="${property.name}">
                        </td>
                        <td>
                            <i class="mdi mdi-delete btn-delete-property font-size-18 text-danger"
                                group-id="${this.id}" property-id="${property.id}"></i>
                        </td>
                    </tr>`
              }.bind(this))
              $(`.tbody-properties-${this.id}`).html(html)
            }
          }
        }
        function createProductGroupList () {
          return {
            groups: [],
            maxGroups: 3,
            params: {},

            addGroup: function (item) {
              this.groups.push(item)
            },
            getNextId: function () {
              try {
                let maxId = this.groups.reduce((a, b) => a.id > b.id ? a : b).id
                return ++maxId
              } catch (e) {
                return 1
              }
            },
            removeGroup: function (id) {
              this.groups = this.groups.filter(group => group.id != id)
            },
            addPropertyGroup (groupId) {
              this.groups = this.groups.map(group => {
                if (group.id == groupId) {
                  group.addEmptyProperty()
                }
                return group
              })
            },
            removePropertyGroup (groupId, proId) {
              let groups = []
              this.groups.forEach(group => {
                if (group.id == groupId) {
                  group.properties = group.properties.filter(item => item.id != proId)
                }
                if (group.properties.length) {
                  groups.push(group)
                }
              })
              this.groups = groups
            },
            updatePropertyGroup (groupId, proId, name, value) {
              this.groups = this.groups.map(group => {
                if (group.id == groupId) {
                  group.properties = group.properties.map(property => {
                    if (property.id == proId) {
                      property[name] = value
                    }
                    return property
                  })
                }
                return group
              })
            },
            updateNameGroup (groupId, name) {
              this.groups = this.groups.map(group => {
                if (group.id == groupId) group.name = name
                return group
              })
            },
            getHtmlHead: function () {
              let html = ``
              $.each(this.groups, function (i, group) {
                html += `<div class="col group-head">${group.name}</div>`
              }.bind(this))
              html += '<div class="col group-head">Price</div><div class="col group-head">SKU</div>'
              return html
            },
            cartesian: function (...args) {
              let r = [], max = args.length - 1
              function helper (arr, i) {
                for (let j = 0, l = args[i].length; j < l; j++) {
                  let a = arr.slice(0) // clone arr
                  a.push(args[i][j])
                  if (i == max)
                    r.push(a)
                  else
                    helper(a, i + 1)
                }
              }

              helper([], 0)
              return r
            },
            getCartesian: function(attr) {
              let names = []
              $.each(this.groups, function (i, group) {
                names.push(group.properties.map(pro => pro[attr]))
              })
              return names.length ? this.cartesian(...names) : []
            },
            initParams: function () {
              let properties = {}
              let cartesianId = this.getCartesian('id')
              if (cartesianId.length) {
                cartesianId = cartesianId.map(function (ar) {
                  return ar.join('-')
                })
                let cartesianName = this.getCartesian('name')
                $.each(cartesianId, function (i, key) {
                  properties[key] = {
                    price: '',
                    sku: '',
                    name: cartesianName[i]
                  }
                })
                $('.group-price').each(function() {
                  if (properties[$(this).attr('property-key')]) {
                    properties[$(this).attr('property-key')].price = $(this).val()
                  }
                })
                $('.group-sku').each(function() {
                  if (properties[$(this).attr('property-key')]) {
                    properties[$(this).attr('property-key')].sku = $(this).val()
                  }
                })
              }
              this.params = properties
              $(`input[name='properties']`).val(JSON.stringify(Object.values(properties)))
              $(`input[name='property_groups']`).val(JSON.stringify(Object.values(this.groups)))
            },
            getHtmlPrice: function () {
              let html = `<div class="row">`
              $.each(this.params, function (key, item) {
                html += `
                    <div class="col-12 group-cell">
                        <input class="group-price" name="group-price" property-key="${key}" type="text" value="${item.price}" placeholder="price">
                    </div>`
              })
              html += `</div>`
              return html
            },
            getHtmlSku: function () {
              let html = `<div class="row">`
              $.each(this.params, function (key, item) {
                html += `
                    <div class="col-12 group-cell">
                        <input class="group-sku" name="group-sku" property-key="${key}" type="text" value="${item.sku}" placeholder="sku">
                    </div>`
              })
              html += `</div>`
              return html
            },
            drawPriceTable () {
              // draw head price
              $('.group-list-price-head').html(this.getHtmlHead())

              // draw price
              let htmlPrice = ''
              htmlPrice += `<div class="col">` + this.getHtmlPrice(this.params) + `</div>`
              htmlPrice += `<div class="col">` + this.getHtmlSku(this.params) + `</div>`


              let height = 1
              let revGroup = [].concat(this.groups).reverse()

              let divide = this.getCartesian('id').length
              let countGroups = revGroup.length
              $.each(revGroup, function (i, group) {
                if (i == countGroups - 1) {
                  divide = group.properties.length
                }
                let countPro = group.properties.length
                let htmlName = '<div class="col">' +  group.getHtmlName(divide / countPro, height) + `</div>`
                htmlPrice = htmlName + htmlPrice
                height *= countPro

                let groups = this.groups.filter(gr => gr.id != group.id)
                let names = []
                $.each(groups, function (i, group) {
                  names.push(group.properties.map(pro => pro.id))
                })
                divide = (names.length ? this.cartesian(...names) : []).length

              }.bind(this))

              $('.group-list-price').html(htmlPrice)
            },
            draw: function () {
              let html = ''
              $.each(this.groups, function (i, group) {
                html += `
                    <div class="group-item">
                        <label for=""class="col-form-label col-lg-2">Tên nhóm phân loại</label>
                        <div class="col-lg-10">
                            <input placeholder="Tên nhóm phân loại" name="group-input-name" group-id="${group.id}" class="form-group group-input-name" value="${group.name}">
                        </div>

                        <i class="mdi mdi-close font-size-18 text-danger btn-delete-group" group-id="${group.id}"></i>
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th>Thuoc tinh</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="tbody-properties-${group.id}"></tbody>
                        </table>
                        <div class="col-12 btn-add-property" group-id="${group.id}"><i class="bx bx-plus"></i></div>
                    </div>`
              })
              html += '<div class="group-item btn-add-group"><div><i class="bx bx-plus"></i></div></div>'
              $('.group-list').html(html)

              // draw properties
              $.each(this.groups, function (i, group) {
                group.draw()
              })
              this.drawPriceTable()

              // check maximum property
              if (this.groups.length >= this.maxGroups) {
                $('.btn-add-group').css('display', 'none')
              }
            },
          }
        }

        // init data
        let groups = createProductGroupList()


        // event
        $(document).on('click', '.btn-add-property', function () {
          groups.addPropertyGroup($(this).attr('group-id'))
          groups.initParams()
          groups.draw()
        })
        $(document).on('click', '.btn-delete-property', function () {
          groups.removePropertyGroup($(this).attr('group-id'), $(this).attr('property-id'))
          groups.initParams()
          groups.draw()
        })
        $(document).on('click', '.btn-add-group', function () {
          let id = groups.getNextId()
          let group = createProductGroup(id)
          groups.addGroup(group)
          groups.initParams()
          groups.draw()
        })
        $(document).on('click', '.btn-delete-group', function () {
          groups.removeGroup($(this).attr('group-id'))
          groups.initParams()
          groups.draw()
        })

        // event input
        $(document).on('keyup', '.property-input-name', function () {
          groups.updatePropertyGroup($(this).attr('group-id'), $(this).attr('property-id'), $(this).attr('property-name'), $(this).val())
          groups.initParams()
          groups.drawPriceTable()
        })
        $(document).on('keyup', '.group-input-name', function () {
          groups.updateNameGroup($(this).attr('group-id'), $(this).val())
          groups.initParams()
          groups.drawPriceTable()
        })
      })
    </script>
@endpush
@push('css-extra')
    <style>
        .product-group {
            margin-bottom: 10px;
        }

        .product-group .btn-add-group {
            margin-top: 5px;
        }

        .product-group .btn-delete-group {
            position: absolute;
            right: 11px;
            top: 10px;
        }

        .product-group .mdi-close {
            background: #fff;
            border: 1px solid #ddd;
            width: 27px;
            height: 29px;
            padding-left: 3px;
        }

        .product-group .btn-add-property {
            text-align: center;
            font-size: 20px;
        }

        .product-group .btn-add-property:hover {
            background-color: #ffffff;
        }

        .product-group .group-cell {
            padding-top: 5px;
            padding-bottom: 5px;
            border-bottom: 1px solid;
            border-right: 1px solid;
            position: relative;
        }

        .product-group .group-cell input {
            width: 100%;
        }

        .product-group .property-name {
            display: block;
            position: absolute;
            top: 25%;
        }

        .product-group .group-list-price {
            border-top: 1px solid;
            border-left: 1px solid;
        }

        .product-group .group-head {
            padding: 5px;
            background-color: #ddd;
            border-left: 1px solid #000;
            border-top: 1px solid #000;
        }

        .product-group .group-list-price-head {
            border-right: 1px solid #000;
        }

        .product-group .group-list {
            margin: 20px 0;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
        }

        .product-group .group-list .group-item {
            position: relative;
            background-color: #f8f8fb;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
    </style>
@endpush


