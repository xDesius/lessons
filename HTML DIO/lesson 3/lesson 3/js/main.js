if (typeof requestAnimationFrame != 'function') {
    ['moz', 'webkit', 'ms'].some(function (p) {
        let f = this[p + 'RequestAnimationFrame']
        return typeof f == 'function' ? (requestAnimationFrame = f) : false
    }) || (requestAnimationFrame = function (f){
        return setTimeout(f, 0)
    })
}

(function (canvas) {

    let thetaEnd = 17 * Math.PI,
        lineSpacing = 1/25,
        lineLength = 0.3 * lineSpacing,
        rate = 1 / (5* Math.PI),
        factor = rate / 2.5,
        cycle = 250,
        scene = [],

        offsetX = 350,
        offsetY= 400,
        scaleX = 450,
        scaleY = 550,
        camX = 0,
        camY = 2,
        camZ = -Math.PI,
        cSize = 700,
        c = document.getElementById('treecanvas').getContext('2d')
        
        canvas.width = canvas.height = cSize
        c.lineWidth = 1.44

        scene.push(new Coil({
            color: '255,0,0',
            theta0: Math.PI
        }))

        scene.push(new Coil({
            color: '0,255,0',
            theta0: Math.PI / 3
        }))

        scene.push(new Coil({
            color: '0,0,255',
            theta0: -Math.PI / 3
        }))
        
        requestAnimationFrame(paint)

        function paint() {
            let offset = 1 - Date.now() / cycle % 1,
                i = 0
                requestAnimationFrame(paint)
                c.clearRect(0, 0, cSize, cSize)
                for (; i < scene.length; ++i)
                scene[i].paint(offset)
        }
        
        function project(point) {
            return [offsetX + scaleX * (point[0] - camX) / -(point[2] + camZ),
            offsetY + scaleY * (point[1] - camY) / -(point[2] + camZ)]
        }

        function clamp(val, a, b) {
            return (val < a) ? a : (val > b) ? b : val
        }

        function pow3(a) {
            return a * a * a
        }

        function Coil(options) {
            this.color =  options.color || '255,255,255'
            this.theta0 = options.theta0 || 0
            this.lineSpacing = options.lineSpacing || lineSpacing
            this.lineLength = options.lineLength || lineLength
            this.rate = options.rate || rate
            this.factor = options.factor || factor
            this.cache = {}
        }

        Coil.prototype.paint = function (offset){
            let cache = this.cache[offset] || (this.cache[offset] = this.compute(offset))
        

        cache[0].forEach(function (b){
            c.beginPath()
            c.moveTo(b[0], b[1])
            c.lineTo(b[2], b[3])
            c.strokeStyle = 'rgba(' + this.color + ',' + b[4] + ')'
            c.stroke()
        }, this)

        c.beginPath()
        cache[1].forEach(function (b){
            c.moveTo(b[0], b[1])
            c.lineTo(b[2], b[3])
        })
            c.strokeStyle = 'rgb(' + this.color + ')'
            c.stroke()
        }

    Coil.prototype.compute = function (offset) {
            let theta = this.thetaDif(0, offset * this.lineSpacing),
                begin, end, cache0 = [],
                cache1 = [],
                i = 0
            for (; theta < thetaEnd; theta += this.thetaDif(theta, this.lineSpacing)) {
                begin = this.getPoint(theta)
                end = this.getPoint(theta + this.thetaDif(theta, this.lineLength))
                this.line(begin, end, cache0, cache1)
            }
            return [cache0, cache1]
    }

    Coil.prototype.thetaDif = function (theta, length) {
        return length / Math.sqrt(this.rate * this.rate + this.factor * this.factor * theta * theta)
    }

    Coil.prototype.getPoint = function (theta) {
        return [theta * this.factor * Math.cos(this.theta0 + theta),
        theta * this.rate,
        theta * this.factor * Math.sin(this.theta0 + theta)]
    }

    Coil.prototype.line = function (begin, end, cache0, cache1) {
        let opacity = 0.24 + 0.76 * pow3(clamp(0.96 + 5.56 * begin[2], 0, 1))
        begin = project(begin)
        end = project(end)
        if (opacity == 1) cache1.push([begin[0], begin[1], end[0], end[1]])
        else cache0.push([begin[0], begin[1], end[0], end[1], opacity])
    }

    scene.forEach(function (obj){
        let offset, i = 0
        for (; i < 200; ++i) {
            offset = 1 - i / cycle % 1
            obj.cache[offset] = obj.compute(offset)
        }
    })
}(document.getElementsByTagName('canvas')[0]))